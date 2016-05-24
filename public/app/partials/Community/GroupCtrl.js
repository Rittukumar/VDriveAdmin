'use strict';


evezownApp.controller('groups' ,function($scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$rootScope,$routeParams,FileUploader,$location,Lightbox,ImageService) {
    $scope.caption = true;

    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.allGroups = [];
    $rootScope.myGroups = [];
    $rootScope.selectedGroup = "";
    $rootScope.allGroupRequest = "";
    $rootScope.allGroupInvites = "";
    $rootScope.allGroupActivities = "";
    $rootScope.selectedActivity = "";
    $scope.visibilties = [];
    $scope.albumImages = [];
    $scope.groupActivityGrade;
    $scope.isProfile = false;
    $scope.selectedVisibility = null;
    $rootScope.showVisibility = "";
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

    $scope.GetAllGroups = function()
    {
        $http.get($scope.service_url + 'users/groups/all').
            success(function (data, status, headers, config)
            {
                console.log(data.data);
                $rootScope.allGroups = data.data;

            }).error(function (data)
            {
                console.log(data);
            }).then(function()
            {
                $scope.GetGroupById($routeParams.group_id);
            }
        );
    }
    $scope.GetMyGroups = function()
    {
        if($routeParams.id != undefined)
        {
            $scope.currentUserId = $routeParams.id;
        }
        else
        {
            $scope.currentUserId = $scope.loggedInUserId;
        }
        $http.get(PATHS.api_url + 'users/'+$scope.currentUserId+'/groups').
            success(function (data, status, headers, config)
            {
                $rootScope.myGroups = data.data;

            }).error(function (data)
            {
                console.log(data);
            }).then(function()
            {
                $scope.GetGroupById($routeParams.group_id);
            }
        );
    }
    $scope.CreateGroup = function()
    {
        ngDialog.open({ template: 'templateId' });
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
                    $scope.GetGroupVisibility();
                }
            });
    }

    $scope.GetGroupVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($rootScope.selectedGroup.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
                $rootScope.showVisibility = value;
            }
        });
    }

    $scope.SaveGroup = function()
    {
        if(!$scope.group)
        {
            toastr.error("Please enter title", 'Group');
        }
        else if(!$scope.description)
        {
            toastr.error("Please enter description", 'Group');
        }
        else
        {
            $http.post($scope.service_url + 'users/groups/create'
                , {
                    data:
                    {
                        title: $scope.group,
                        description:$scope.description,
                        user_id:$cookieStore.get('userId'),
                        visibility_id: $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Groups');
                    $scope.Group_Id = data.id;

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Groups');
                }).then(function()
                {
                    var Group_ID = $scope.Group_Id;
                    $location.path('/groups/'+Group_ID);
                    //$scope.GetAllGroups();
                    //$scope.GetMyGroups();
                });
        }
    }

    $scope.EditGroup = function()
    {
        ngDialog.open({ template: 'EdittemplateId' });
    }

    $scope.UpdateGroup= function(selectedGroup)
    {
        if(!$scope.selectedGroup.title)
        {
            toastr.error("Please enter title", 'Group');
        }
        else if(!$scope.selectedGroup.description)
        {
            toastr.error("Please enter description", 'Group');
        }
        else
        {
            $http.post($scope.service_url + 'users/groups/update'
                , {
                    data:
                    {
                        title: selectedGroup.title,
                        description:selectedGroup.description,
                        user_id:$cookieStore.get('userId'),
                        visibility_id: $scope.selectedVisibility.id,
                        group_id : selectedGroup.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Groups');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Groups');
                }).then(function()
                {
                    $scope.GetAllGroups();
                    $scope.GetMyGroups();
                });
        }
    }

    $scope.DeleteGroup = function(group)
    {
        $http.get($scope.service_url + 'users/groups/'+group.id+'/delete').
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {
                $location.path('/groups');
                $scope.GetAllGroups();
                $scope.GetMyGroups();
            });
    }

    $scope.JoinGroup = function(group)
    {
        $http.post($scope.service_url + 'users/groups/member/request'
            , {
                data:
                {
                    group_id:group.id,
                    user_id:$cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {

            });
    }

    $scope.GetAllGroupInvites = function()
    {
        $http.get(PATHS.api_url + 'users/groups/requests/member/'+$cookieStore.get('userId')).
            success(function (data)
            {
                $scope.allGroupRequest = data.data;
            });
    }

    $scope.GetAllGroupActivities = function(groupId)
    {
        $http.get(PATHS.api_url + 'users/groups/'+groupId+'/activities').
            success(function (data)
            {
                console.log(data);
                $rootScope.allGroupActivities = data.data;
            });
    }

    $scope.LoadActivity = function(actId)
    {
        //$scope.GetActivityById(actId);
        //$location.path('/);
    }

    $scope.GetGroupActivityGrade = function(group_activity_id)
    {
        $http.get($scope.service_url + 'users/groups/activities/grade/'+group_activity_id+'/get').
            success(function (data)
            {
                $scope.groupActivityGrade = data;
            });
    }


    $scope.UpdateGroupActivityGrade = function(scale,group_activity_id)
    {
        $http.post($scope.service_url + 'users/groups/activities/grade/add'
            , {
                data:
                {
                    scale:scale,
                    group_activity_id : group_activity_id,
                    owner_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.groupActivityGrade = data.avgGrade;
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {

                $scope.GetActivityById(group_activity_id);
            });
    }

    $scope.GetAllGroupRequests = function()
    {
        $http.get(PATHS.api_url + 'users/groups/requests/owner/'+$cookieStore.get('userId')).
            success(function (data)
            {
                console.log(data.data);
                $scope.allGroupInvites = data.data;
            });
    }

    $scope.SetRequest = function(request,status)
    {
        var url = "";
        if(status)
        {
            url = $scope.service_url + 'users/groups/requests/owner/accept';
        }
        else
        {
            url = $scope.service_url + 'users/groups/requests/owner/reject';
        }
        $http.post(url
            , {
                data:
                {
                    group_id:request.group.id,
                    user_id:request.profile.user_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {
                $scope.GetAllGroupInvites();
            });
    }

    $scope.SetInviteStatus = function(request,status)
    {
        var url = "";
        if(status)
        {
            url = $scope.service_url + 'users/groups/requests/owner/accept';
        }
        else
        {
            url = $scope.service_url + 'users/groups/requests/owner/reject';
        }

        //alert(url);

        $http.post(url
            , {
                data:
                {
                    group_id:request.group.id,
                    user_id:request.profile.user_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {
                $scope.GetAllGroupRequests();
                $scope.GetMyGroups();
            });
    }


    $scope.GetGroupById = function(groupId)
    {
        //users/groups/
        $http.get(PATHS.api_url + 'users/groups/'+groupId).
            success(function (data)
            {
                $rootScope.selectedGroup  = data.data;
            }).error(function (data)
            {

            }).then(function()
            {
                $scope.GetAllGroupActivities(groupId);
                $scope.GetVisibility();
                $scope.fetchFriends();
            });;
    }

    $scope.GetActivityById = function(activityId)
    {
        //angular.forEach($scope.allGroupActivities, function (value, key)
        //{
        //    if(activityId == value.id)
        //    {
        //        $scope.selectedActivity = value;
        //        $scope.groupActivityGrade = $scope.selectedActivity.scale;
        //    }
        //});

        //users/groups/activities/{group_activity_id}

        $http.get($scope.service_url + 'users/groups/activities/'+activityId).
            success(function (data, status, headers, config)
            {
                $scope.selectedActivity = data.data;
                $scope.groupActivityGrade = $scope.selectedActivity.scale;
            }).error(function (data)
            {

            }).then(function()
            {
                $scope.GetVisibility();
            });
    }

    //function fetchFriends() {
    //    friendsService.getFriends().then(function(data)
    //    {
    //        $scope.friendsCount = data.data.count,
    //        $scope.friendList = data.data;
    //        if($scope.selectedGroup.members.length > 0)
    //        {
    //            angular.forEach($scope.selectedGroup.members, function (member, key)
    //            {
    //                angular.forEach($scope.friendList, function (friend, key)
    //                {
    //                    if(friend.profile.user_id == member.profile.user_id)
    //                    {
    //                        var index = array.indexOf(friend);
    //                        $scope.friendList.splice(index);
    //                    }
    //                });
    //
    //            });
    //        }
    //
    //
    //    });
    //}
//users/{id}/{event_id}/eventfriends
    $scope.fetchFriends = function()
    {
        //PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/circlefriends'
        $http.get(PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/'+$routeParams.group_id+'/groupfriends').
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

    $scope.AddFriendsToGroup = function(memberId,groupId)
    {
        $http.post($scope.service_url + 'users/groups/member/add'
            , {
                data:
                {
                    group_id:groupId,
                    user_id:memberId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {
               $scope.fetchFriends();
               $scope.GetGroupById(groupId);
            });
    }

    $scope.RemoveFriendFromGroup = function(memberId,groupId)
    {
        $http.post($scope.service_url + 'users/groups/member/remove'
            , {
                data:
                {
                    group_id:groupId,
                    user_id:memberId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');
            }).then(function()
            {
                //$scope.GetAllGroups();
                //$scope.GetMyGroups();
                $scope.fetchFriends();
                $scope.GetGroupById(groupId);
            });
    }

    var uploader = $scope.uploader = new FileUploader({
        url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
        removeAfterUpload: true,
        method: 'POST',
        autoUpload:false,
        alias: 'image'
    });

    // FILTERS

    uploader.filters.push({
        name: 'imageFilter',
        fn: function (item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });


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
        $scope.albumImages.push(response.imageName);
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
    uploader.onCompleteAll = function()
    {
        var linkArray = [];
        if($scope.url_link)
        {
            var linkArray = [$scope.url_link];
        }
        $http.post(PATHS.api_url + 'users/groups/activities/create'
            , {
                data: {
                    group_id: $routeParams.group_id,
                    title: $scope.aTitle,
                    description: $scope.adescription,
                    images: $scope.albumImages,
                    url_link: linkArray,
                    user_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.albumImages = [];
                $scope.url_link = null;
                toastr.success(data.message, 'Groups');
                ngDialog.close();

            }).error(function (data)
            {
                $scope.albumImages = [];
                toastr.error(data.error.message, 'Groups');

            }).then(function()
            {
                $scope.aTitle = "";
                $scope.adescription = "";
                $scope.GetAllGroupActivities($routeParams.group_id);
            });
    };


    var uploader1 = $scope.uploader1 = new FileUploader({
        url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
        removeAfterUpload: true,
        method: 'POST',
        autoUpload:true,
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
        $http.post(PATHS.api_url + 'users/groups/image/update'
            , {
                data: {
                    image_name: response.imageName,
                    group_id: $routeParams.group_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                ImageService.getImage(PATHS.api_url + 'users/groups/' + $routeParams.group_id + '/cover_image/current').success(function(data){
                    $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
                });
                toastr.success(data.message, 'Events');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Events');
            });
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
    };


    $scope.CreateActivity = function(uploader,selectedGroup)
    {
        if(!$scope.aTitle)
        {
            toastr.error("Please enter title", 'Groups');
        }
        else if(!$scope.adescription)
        {
            toastr.error("Please enter description", 'Groups');
        }
        else
        {
            if(uploader.queue.length > 0)
            {
                uploader.uploadAll();
            }
            else
            {
                var linkArray = null;
                if($scope.url_link)
                {
                    var linkArray = [$scope.url_link];
                }
                $http.post(PATHS.api_url + 'users/groups/activities/create'
                    , {
                        data: {
                            group_id: selectedGroup.id,
                            title: $scope.aTitle,
                            description: $scope.adescription,
                            images: $scope.albumImages,
                            url_link: linkArray,
                            user_id: $cookieStore.get('userId')
                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                    success(function (data, status, headers, config)
                    {
                        $scope.albumImages = [];
                        $scope.url_link = null;
                        toastr.success(data.message, 'Groups');
                        ngDialog.close();

                    }).error(function (data)
                    {
                        toastr.error(data.error.message, 'Groups');

                    }).then(function()
                    {
                        $scope.albumImages = null;
                        $scope.GetAllGroupActivities(selectedGroup.id);
                    });
            }
        }
    }
    $scope.AddActivity = function()
    {
        ngDialog.open({ template: 'templateId' });
    }


    /*$scope.RemoveFriendFromGroup = function(memberId,groupId)
    {
        
        $http.post(PATHS.api_url + 'users/groups/member/remove'
            , {
                data: {
                    group_id: groupId,
                    user_id: memberId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');

            }).then(function()
            {
                $scope.GetAllGroupActivities($routeParams.group_id);
            });
    }*/

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

    //Get group cover image
    ImageService.getImage(PATHS.api_url + 'users/groups/' + $routeParams.group_id + '/cover_image/current').success(function(data){
        
        if(data == "NoCoverImage")
        {
            $rootScope.coverImage = null;
        }
        else
        {
            $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
        }
    });

    $scope.GetVisibility();
    //$scope.GetAllGroups();
    $scope.GetMyGroups();
    $scope.GetAllGroupInvites();
    $scope.GetAllGroupRequests();



});

/*Group Cover Image change*/
evezownApp
    .controller('GroupCoverImageChange', function ($scope, AuthService, ngDialog, $location, $controller, $http, $cookieStore, PATHS, FileUploader, $rootScope, $routeParams) {


    $scope.ChangeGroupCover = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'GroupCover',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('GroupCoverCropCtrl', {
                $scope: $scope
            })
        });
    }
});

/*Group Cover Image crop*/
evezownApp.controller('GroupCoverCropCtrl', function ($scope, StoreService,$http, PATHS,ImageService,
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

    $scope.slideImage.aspectRatio = 800 / 250;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 800 / 250;

    $scope.ChangeGroupCoverImage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                $http.post(PATHS.api_url + 'users/groups/image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        group_id: $routeParams.group_id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    $rootScope.coverImage = "";
                    ImageService.getImage(PATHS.api_url + 'users/groups/' + $routeParams.group_id + '/cover_image/current').success(function(data){
                    $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
                    toastr.success("Group Cover Updated");
                    ngDialog.close("", data);
                    });
                    });
                    
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});