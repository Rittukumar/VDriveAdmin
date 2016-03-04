'use strict';


evezownApp.controller('eventCtrl' ,function($scope, PATHS,$cookieStore,$http,$rootScope,$location,$routeParams,friendsService,$filter,ngDialog,FileUploader,ImageService,Lightbox)
{
    $scope.caption = true;
    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.allEvents = [];
    $scope.myEvents = [];
    $scope.allEventInvites = [];
    $scope.selectedEvent = "";
    $scope.visibilties = [];
    $scope.isOnLoad = true;
    $scope.eventGrade;
    $scope.isProfile = false;
    $scope.date = new Date();
    $rootScope.coverImage = null;
    $scope.myEventActivities = null;
    $scope.activityImages = [];
    $scope.eventactivity ="";
    $scope.imagePath = PATHS.api_url +'image/show/';
    $scope.isActive = ['', 'active', '', ''];

    if($routeParams.id != undefined)
    {
        $scope.currentUserId = $routeParams.id;
        $scope.isProfile = true;
    }
    else
    {
        $scope.currentUserId = $scope.loggedInUserId;
        $scope.isProfile = false;
    }


    $scope.openLightBox = function (images, index) {
        $scope.imagesitems = [];

        angular.forEach(images, function (value, key)
            {
                $scope.imagesitems.push(value.large_image_url);
            },
            $scope.imagesitems);
        Lightbox.baseURI = '';
        Lightbox.openModal($scope.imagesitems, index);
    }
    $scope.CreateEvent = function()
    {

        if(!$scope.title)
        {
            toastr.error("Please enter title", 'Event');
        }
        else if(!$scope.description)
        {
            toastr.error("Please enter description", 'Event');
        }
        else if(!$scope.duration)
        {
            toastr.error("Please enter event duration", 'Event');
        }

        else if(!$scope.location)
        {
            toastr.error("Please enter event location", 'Event');
        }
        else
        {   
            //split start time
            var startTime1 = $scope.duration.startDate._d;
            var startTime2 = String(startTime1)
            var startTime3 = startTime2.split(" ");
            var StartTime  = startTime3[4];

            //split end time
            var endTime1 = $scope.duration.endDate._d;
            var endTime2 = String(endTime1)
            var endTime3 = endTime2.split(" ");
            var EndTime  = endTime3[4];

            $http.post($scope.service_url + 'users/events/create'
                , {
                    data:
                    {
                        title: $scope.title,
                        user_id:$cookieStore.get('userId'),
                        description:$scope.description,
                        start_date:$scope.duration.startDate,
                        end_date:$scope.duration.endDate,
                        start_time:StartTime,
                        end_time:EndTime,
                        location:$scope.location,
                        visibility_id : $scope.selectedVisibility.id

                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Event');
                    $scope.Event_Id = data.id;

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Event');

                }).then(function(data)
                {
                    var Event_ID = $scope.Event_Id;
                    $location.path('/eventdetails/'+Event_ID);
                });
        }
    }

    $scope.GetEventGrade = function(event_id)
    {
        $http.get($scope.service_url + 'users/events/grade/'+event_id+'/get').
            success(function (data)
            {
                $rootScope.eventGrade = data;
            });
    }

    //users/events/activities/create
    //users/events/activities/update


    $scope.CreateActivity = function(files,announcement)
    {
        $scope.eventactivity = announcement;
        if(files.queue.length > 0)
        {
            files.uploadAll();
        }
        else
        {
            $scope.CreateEventActivities($routeParams.event_id);
        }
    }

    $scope.CreateEventActivities = function (eventid)
    {
        var postImages = $scope.activityImages;
        if($scope.eventactivity == undefined)
        {
            toastr.error("Please enter announcements", 'Event');
        }
        else if($scope.eventactivity == "")
        {
            toastr.error("Please enter announcements", 'Event');
        }
        else
        {
            $http.post(PATHS.api_url + 'users/events/activities/create'
                , {
                    data: {
                        user_id: $cookieStore.get('userId'),
                        comment: $scope.eventactivity,
                        event_id: eventid,
                        images: postImages

                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Event');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Event');
                }).then(function()
                {
                    $scope.eventactivity = "";
                    $scope.activityImages = [];
                    $scope.GetEventActivities();
                });
        }

    }

    $scope.GetEventActivities = function()
    {
        $http.get(PATHS.api_url + 'users/events/'+$routeParams.event_id+'/activities/all').
            success(function (data)
            {
                $scope.myEventActivities = data.data;
            });
    }

    $scope.DeleteEventActivities = function(eventActivityId)
    {
        $http.get(PATHS.api_url + 'users/events/activities/'+eventActivityId+'/delete').
            success(function (data)
            {
                toastr.success(data.message, 'Events');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Events');
            }).then(function()
            {
                $scope.GetEventActivities();
            });
    }



    $scope.UpdateEventGrade = function(scale,event_id)
    {
        $http.post($scope.service_url + 'users/events/grade/add'
            , {
                data:
                {
                    scale:scale,
                    event_id : event_id,
                    owner_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.eventGrade = data.avgGrade;
                toastr.success(data.message, 'Events');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Events');
            }).then(function()
            {

                $scope.GetEventById(event_id);
            });
    }


    $scope.GetAllEvents = function()
    {
        $http.get(PATHS.api_url + 'users/events/all').
            success(function (data)
            {
                $scope.allEvents = data.data;
                if($routeParams.event_id != undefined)
                {
                    $scope.GetEventById($routeParams.event_id);
                }
            });
    }

    $scope.GetMyEvents = function()
    {
        if($routeParams.id != undefined)
        {
            $scope.currentUserId = $routeParams.id;
        }
        else
        {
            $scope.currentUserId = $scope.loggedInUserId
        }
        $http.get(PATHS.api_url + 'users/'+$scope.currentUserId+'/events').
            success(function (data)
            {
                $scope.myEvents = data.data;
                if($routeParams.event_id != undefined)
                {
                    $scope.GetEventById($routeParams.event_id);
                }
            });
    }

   /* $scope.$watch('selectedEvent.start_date', function(newvalue,oldvalue)
    {
        if(oldvalue)
        {
            if(oldvalue != newvalue)
            {
                newvalue = [{ "time" : newvalue }];
                var filterdatetime = $filter('time')( newvalue[0].time );
                $scope.selectedEvent.start_time =  filterdatetime;
            }
        }

    });

    $scope.$watch('selectedEvent.end_date', function(newvalue,oldvalue)
    {
        if(oldvalue)
        {
            newvalue = [{ "time" : newvalue }];
            if(oldvalue != newvalue)
            {
                var filterdatetime = $filter('time')( newvalue[0].time );
                $scope.selectedEvent.end_time =   filterdatetime;
            }
        }
    });

    $scope.$watch('startdate', function(newvalue,oldvalue)
    {
        if(newvalue != "")
        {
            newvalue = [{ "time" : newvalue }];
            var filterdatetime = $filter('time')( newvalue[0].time );
            $scope.starttime =  filterdatetime;
        }

    });

    $scope.$watch('enddate', function(newvalue,oldvalue)
    {
        if(newvalue != "")
        {
            newvalue = [{ "time" : newvalue }];
            var filterdatetime = $filter('time')( newvalue[0].time );
            $scope.endtime =   filterdatetime;
        }
    });*/




    $scope.GetAllEventInvites = function()
    {
        $http.get(PATHS.api_url + 'users/'+$cookieStore.get('userId')+'/events/invites/get').
            success(function (data)
            {
                if(data)
                {
                    $scope.allEventInvites = data;
                }
                else
                {
                    $scope.allEventInvites = [];
                }

            });
    }

    var uploader = $scope.uploader = new FileUploader({
        url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
        removeAfterUpload: true,
        method: 'POST',
        autoUpload:true,
        alias: 'image'
    });





    uploader.filters.push({
        name: 'imageFilter',
        fn: function (item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    // CALLBACKS





    uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader.onAfterAddingAll = function(addedFileItems)
    {
        $scope.counter = addedFileItems.length;
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader.onBeforeUploadItem = function(item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader.onProgressItem = function(fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader.onSuccessItem = function(fileItem, response, status, headers)
    {
        $http.post(PATHS.api_url + 'users/events/image/update'
            , {
                data: {
                    image_name: response.imageName,
                    event_id: $routeParams.event_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                ImageService.getImage(PATHS.api_url + 'users/events/' + $routeParams.event_id + '/cover_image/current').success(function(data){
                    $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
                });
                toastr.success(data.message, 'Events');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Events');
            });
    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers)
    {

    };
    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
    };


    var uploader1 = $scope.uploader1 = new FileUploader({
        url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
        removeAfterUpload: true,
        method: 'POST',
        autoUpload:false,
        alias: 'image'
    });





    uploader1.filters.push({
        name: 'imageFilter',
        fn: function (item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    // CALLBACKS





    uploader1.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader1.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader1.onAfterAddingAll = function(addedFileItems)
    {
        $scope.counter = addedFileItems.length;
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader1.onBeforeUploadItem = function(item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader1.onProgressItem = function(fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader1.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader1.onSuccessItem = function(fileItem, response, status, headers)
    {
        $scope.activityImages.push(response.imageName);
    };
    uploader1.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader1.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader1.onCompleteItem = function(fileItem, response, status, headers)
    {

    };
    uploader1.onCompleteAll = function()
    {
        $scope.CreateEventActivities($routeParams.event_id);
    };


    $scope.DeleteEvent = function($eventId)
    {
        $http.get(PATHS.api_url + 'event/'+$eventId+'/delete').
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Event');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Event');

            }).then(function(data)
            {
                $location.path('/events');
            });
    }

    $scope.UpdateEvent = function(currentEvent,post)
    {

        if(!currentEvent.title)
        {
            toastr.error("Please enter title", 'Event');
        }
        else if(!currentEvent.description)
        {
            toastr.error("Please enter description", 'Event');
        }
        else if(!$scope.duration)
        {
            toastr.error("Please enter event duration", 'Event');
        }
        else if(!$scope.location)
        {
            toastr.error("Please enter event location", 'Event');
        }
        else
        {
            //split start time
            var startTime1 = $scope.duration.startDate._d;
            var startTime2 = String(startTime1)
            var startTime3 = startTime2.split(" ");
            var StartTime  = startTime3[4];

            //split end time
            var endTime1 = $scope.duration.endDate._d;
            var endTime2 = String(endTime1)
            var endTime3 = endTime2.split(" ");
            var EndTime  = endTime3[4];
            $http.post($scope.service_url + 'users/events/update'
                , {
                    data:
                    {
                        title: currentEvent.title,
                        user_id:$cookieStore.get('userId'),
                        description:currentEvent.description,
                        start_date:$scope.duration.startDate,
                        end_date:$scope.duration.endDate,
                        start_time:StartTime,
                        end_time:EndTime,
                        location:$scope.location,
                        locationId:currentEvent.location.id,
                        event_id:currentEvent.id,
                        visibility_id : $scope.selectedVisibility.id

                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Event');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Event');

                }).then(function(data)
                {
                    $location.path('/eventdetails/'+currentEvent.id);
                });
        }
    }

    $scope.WoiceIt = function ()
    {
        ngDialog.open({ template: 'WoicetemplateId' });
    }

    //users/events/image/update
    $scope.UpdateCoverImage = function (event)
    {

    }

    $scope.CreateWoice = function (event)
    {
        var postImages = [];
        if($scope.WoiceTitle == undefined)
        {
            toastr.error("Please enter title", 'Event');
        }
        else if($scope.WoiceTitle == "")
        {
            toastr.error("Please enter title", 'Event');
        }
        else
        {
            $http.post(PATHS.api_url + 'users/' + $cookieStore.get('userId') + '/post/create'
                , {
                    data: {
                        title: $scope.WoiceTitle,
                        owner_id: $cookieStore.get('userId'),
                        description: $scope.Woicedescription,
                        testimonial: event.description,
                        visibility_id: 1,
                        post_type_id: 1,
                        url_link: '#eventdetails/'+event.id,
                        images: postImages

                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Event');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Event');
                });
        }

    }


    $scope.GetEventById = function(eventId)
    {
        $http.get($scope.service_url + 'users/events/'+eventId).
            success(function (data, status, headers, config)
            {
                $scope.selectedEvent = data.data;
                $scope.eventGrade = $scope.selectedEvent.scale;
                $scope.sd = $scope.selectedEvent.start_date +" "+ $scope.selectedEvent.start_time;
                $scope.ed = $scope.selectedEvent.end_date +" "+ $scope.selectedEvent.end_time;
                $scope.duration = {"startDate":$scope.sd,"endDate":$scope.ed}
                $scope.location = $scope.selectedEvent.location.locality;
            }).error(function (data)
            {

            }).then(function()
            {
                $scope.GetVisibility();
            });
    }

    $scope.SetInviteStatus = function(eventInviteResponse,eventId)
    {
        $http.post($scope.service_url + 'users/events/invite/rsvp'
            , {
                data:
                {
                    friend_user_id: $cookieStore.get('userId'),
                    event_id:eventId,
                    rsvp:eventInviteResponse
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Event');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Event');

            }).then(function(data)
            {
                $scope.fetchFriends();
                $scope.GetAllEventInvites();
            });
    }


    $scope.AddFriendsToEvents = function(member)
    {
        $http.post($scope.service_url + 'users/events/invite'
            , {
                data:
                {
                    event_id: $routeParams.event_id,
                    friend_user_id:member.friend_user_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Event');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Event');
            }).then(function()
            {
                $scope.fetchFriends();
            });
    }

    $scope.GetEventVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($scope.selectedEvent.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
            }
        });
    }

    $scope.GetVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        $http.get(PATHS.api_url + 'visibility').
            success(function (data) {
                $scope.visibilties = data;
                if ($scope.visibilties.length > 0)
                {
                    $scope.selectedVisibility = $scope.visibilties[0];
                    $scope.GetEventVisibility();
                }
            });
    }
    //
    //function fetchFriends() {
    //    friendsService.getFriends().then(function(data)
    //    {
    //        $http.get(PATHS.api_url + 'users/' + $cookieStore.get('userId') + '/friends')
    //            .success(function (data)
    //            {
    //                $scope.friendList = data.data;
    //            })
    //            .error(function (err)
    //            {
    //                console.log('Error retrieving friends');
    //
    //            }).then(function (data)
    //            {
    //            });
    //    });
    //}

    $scope.fetchFriends = function()
    {
        //PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/circlefriends'
        $http.get(PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/'+$routeParams.event_id+'/eventfriends').
            success(function (data, status, headers, config)
            {
                $scope.friendsCount = data.data.length;
                $scope.friendList = []
                $scope.friendList = data.data;
            }).error(function (data)
            {

            }).then(function(data)
            {

            });
    }

    ImageService.getImage(PATHS.api_url + 'users/events/' + $routeParams.event_id + '/cover_image/current').success(function(data){
        if(data == "NoCoverImage")
        {
            $rootScope.coverImage = null;
        }
        else
        {
            $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
        }
    });

    $scope.fetchFriends();
    $scope.GetVisibility();
   // $scope.GetAllEvents();
    $scope.GetMyEvents();
    if($routeParams.event_id)
    {
        $scope.GetEventActivities();
    }
    $scope.GetAllEventInvites();


});

/*Event Cover Image change*/
evezownApp
    .controller('EventCoverImageChange', function ($scope, AuthService, ngDialog, $location, $controller, $http, $cookieStore, PATHS, FileUploader, $rootScope, $routeParams) {


    $scope.ChangeEventCover = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'EventCover',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('EventCoverCropCtrl', {
                $scope: $scope
            })
        });
    }
});

/*Event Cover Image crop*/
evezownApp.controller('EventCoverCropCtrl', function ($scope, StoreService,$http, PATHS,ImageService,
                                                      usSpinnerService, ngDialog, $routeParams, $rootScope) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 800 / 350;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 800 / 350;

    $scope.ChangeEventCoverImage = function () {

       usSpinnerService.spin('spinner-1');
        StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                $http.post(PATHS.api_url + 'users/events/image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        event_id: $routeParams.event_id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    $rootScope.coverImage = "";
                    ImageService.getImage(PATHS.api_url + 'users/events/' + $routeParams.event_id + '/cover_image/current').success(function(data){
                    $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
                    toastr.success("Event Cover Updated");
                    ngDialog.close("", data);
                    });
                    });
                    
            });
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

//Filter to limit the caracter
evezownApp.filter('strLimit', ['$filter', function($filter)
{
   return function(input, limit) {
     if (! input) return;
     if (input.length <= limit) {
          return input;
      }
    
      return $filter('limitTo')(input, limit) + '...';
   };
}]);

evezownApp.factory('ImageService', function($http)
{
    var image = null;
    return {
        getImage: function(imagePath)
        {
            return $http({
                url: imagePath,
                method: 'GET'
            })
        }
    }
})

evezownApp.filter('time', function($filter)
{
    return function(input)
    {
        if(input == null){ return ""; }

        var _date = $filter('date')(new Date(input), 'HH:mm:ss');

        return _date.toUpperCase();

    };
});