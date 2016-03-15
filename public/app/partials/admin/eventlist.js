'use strict';

evezownApp
    .controller('eventlists',
        function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService, Session, ngDialog, $rootScope, $cookieStore, $location, ngTableParams, EventService, $controller) {
            $scope.events = [];
            $scope.caption = true;
            $scope.service_url = PATHS.api_url;
            $scope.date = new Date();
            $scope.selectedVisibility = "";
            $scope.selectedEvent = "";
            $scope.visibilties = [];
            $scope.isOnLoad = true;
            $scope.loggedInUserId = $cookieStore.get('userId');
            $scope.title = "Events";
	    $scope.getEvents = [];
            $scope.eventPagination = {};
            $scope.imageUrl =  PATHS.api_url + 'image/show/';

            usSpinnerService.spin('spinner-1');

            $http.get(PATHS.api_url + 'users/events/all').
            success(function (data) {

                $scope.events = data.data;
                // $scope.paging = data.meta.pagination;
                // $scope.totalPages = new Array(Number($scope.paging.total_pages));
                // $scope.active = $scope.paging.current_page;
                // $scope.next = data.meta.next;
                usSpinnerService.stop('spinner-1');


                $scope.eventAdminTableParams = new ngTableParams({
                    page: 1,            // show first page
                    count: 10           // count per page
                }, {
                    total: $scope.events.length, // length of data
                    getData: function ($defer, params) {
                        $defer.resolve($scope.events.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                    }
                })

                $scope.EditEvent = function (selectedEvent) {


                    $location.path('/editevents/' + selectedEvent.id);
                    $rootScope.currentEvent = selectedEvent;
                    //$scope.GetVisibility();
                }

                $scope.$watch('currentEvent', function (newValue, oldValue) {
                    $rootScope.currentEvent = newValue;
                    $scope.GetVisibility();
                    $scope.GetAllEvents();

                });
                $scope.GetVisibility = function () {
                    //Loading user visibility section (with all,circle,friends,me)
                    $http.get(PATHS.api_url + 'visibility').
                    success(function (data) {
                        $scope.visibilties = data;
                        if ($scope.visibilties.length > 0) {
                            $scope.selectedVisibility = $scope.visibilties[0];
                            $scope.GetEventVisibility();

                        }
                    });
                }
                $scope.GetEventVisibility = function () {
                    //Loading user visibility section (with all,circle,friends,me)
                    angular.forEach($scope.visibilties, function (value, key) {
                        if ($scope.currentEvent.visibility_id == value.id) {
                            $scope.selectedVisibility = value;
                            $rootScope.showVisibility = value;
                        }
                    });
                }


                $scope.GetAllEvents = function () {
                    $http.get(PATHS.api_url + 'users/events/all').
                    success(function (data) {
                        $scope.allEvents = data.data;
                        if ($routeParams.event_id != undefined) {
                            $scope.GetEventById($routeParams.event_id);
                        }
                    });
                }

                function fetchEvents() {
                    usSpinnerService.spin('spinner-1');
                    EventService.getEvents().then(function (data) {

                        usSpinnerService.stop('spinner-1');

                        $scope.events = data;
                    });
                }

                fetchEvents();

                $scope.DeleteEventDialog = function (id) {
                    //ngDialog.open({ template: 'deleteEventTemplateId' });
                    var deleteEventDialog = ngDialog.open(
                        {
                            template: 'deleteEventTemplateId',
                            scope: $scope,
                            controller: $controller('deleteEventCtrl', {
                                $scope: $scope,
                                eventId: id
                            })
                        });

                    deleteEventDialog.closePromise.then(function (data) {

                        if (data.value.status) {
                            toastr.success(data.value.message, 'Event deleted');
                            fetchEvents();
                        }
                    });
                }

//pagination
$scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentEventPage);
            $scope.GetEventPagination();
        };

        $scope.maxSize = 1;
        $scope.GetEventPagination = 1;

        $scope.GetEventPagination = function () {
            $http.get(PATHS.api_url + 'admin/'+$cookieStore.get('userId')+'/users?page='+$scope.currentEventPage).
            success(function(data) {
                    console.log(data);
                    $scope.getEvent = data.data;
                    usSpinnerService.stop('spinner-1');
                    $scope.eventPagination = data.meta.pagination;
                }).then(function () {

                });
        }
        $scope.GetEventPagination();
//pagination end


$scope.GetEventById = function()
{
    $http.get($scope.service_url + 'users/events/'+$routeParams.event_id).
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

                    }).then(function () {
                        $scope.GetVisibility();
                    });
                };

                $scope.UpdateEvent = function (currentEvent, post) {


                    if (!currentEvent.title) {
                        toastr.error("Please enter title", 'Event');
                    }
                    else if (!currentEvent.description) {
                        toastr.error("Please enter description", 'Event');
                    }
                    else if (!$scope.duration) {
                        toastr.error("Please enter event duration", 'Event');
                    }
                    else if (!$scope.location) {
                        toastr.error("Please enter event location", 'Event');
                    }
                    else {
                        //split start time
                        var startTime1 = $scope.duration.startDate._d;
                        var startTime2 = String(startTime1)
                        var startTime3 = startTime2.split(" ");
                        var StartTime = startTime3[4];

                        //split end time
                        var endTime1 = $scope.duration.endDate._d;
                        var endTime2 = String(endTime1)
                        var endTime3 = endTime2.split(" ");
                        var EndTime = endTime3[4];
                        $http.post($scope.service_url + 'users/events/update'
                            , {
                                data: {
                                    title: currentEvent.title,
                                    user_id: $cookieStore.get('userId'),
                                    description: currentEvent.description,
                                    start_date: $scope.duration.startDate,
                                    end_date: $scope.duration.endDate,
                                    start_time: StartTime,
                                    end_time: EndTime,
                                    location: $scope.location,
                                    locationId: currentEvent.location.id,
                                    event_id: currentEvent.id,
                                    visibility_id: $scope.selectedVisibility.id

                                },
                                headers: {'Content-Type': 'application/json'}
                            }).
                        success(function (data, status, headers, config) {
                            toastr.success(data.message, 'Event');

                        }).error(function (data) {
                            toastr.error(data.error.message, 'Event');

                        }).then(function (data) {
                            $scope.GetAllEvents();
                            $location.path('/admin/events');
                        });
                    }
                };

                // Show the dialog to set the options for show blog in evezplace
                //  Eg: evezplace section (product, service etc) and priority.
                $scope.showInEvezplaceDialog = function (event) {

                    console.log('Click show in marketplace');
                    var showInEvezplaceDialog = ngDialog.open(
                        {
                            template: 'showEventInEvezplaceTemplateId',
                            scope: $scope,
                            controller: $controller('showEventEvezplaceCtrl', {
                                $scope: $scope,
                                event: event
                            })
                        });

                    showInEvezplaceDialog.closePromise.then(function (data) {

                        fetchEvents();

                        console.log(data);

                        if (data.value.status) {
                            toastr.success(data.value.message, 'Blog added to Marketplace section');
                        }
                    });

                }

                // $scope.DeleteEvent = function(event)
                // {

                // $http.get(PATHS.api_url + 'event/'+event.id+'/delete').
                // success(function (data, status, headers, config)
                //         {
                //             toastr.success(data.message, 'Event');

                //         }).error(function (data)
                //         {
                //             toastr.error(data.error.message, 'Event');

                //         }).then(function(data)
                //         {
                //             $location.path('/admin/events');
                //         });
                // }


            });
        });

evezownApp.controller('deleteEventCtrl', function ($scope, EventService, $cookieStore,
                                                   usSpinnerService, eventId, ngDialog) {
    console.log(eventId);

    // Delete Group item
    $scope.eventId = eventId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteEvent = function () {
        usSpinnerService.spin('spinner-1');
        EventService.deleteEvent($scope.userId, $scope.eventId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close("", data);
        });
    }

    $scope.cancelDeleteEvent = function () {
        ngDialog.close();
    }
});


evezownApp.controller('showEventEvezplaceCtrl', function ($scope, EventService, EvezplaceHomeService, $cookieStore,
                                                         usSpinnerService, event, ngDialog) {

    $scope.eventId = event.id;
    $scope.userId = $cookieStore.get('userId');

    function getEvezplaceSection(userId) {
        EvezplaceHomeService.getSections(userId).
        then(function (data) {
            $scope.sections = data;
            $scope.selectedSectionId = $scope.sections[0].id;
        }, function (error) {
            toastr.error(error.error.message, 'Marketplace Sections');
        });
    }

    $scope.options = {
        priority: 0,
        selectedSectionId: 3,
        is_show_evezplace: false
    };

    if(event.trending != null) {
        $scope.options.priority = event.trending.priority;
        $scope.options.selectedSectionId = event.trending.evezown_section_id;
        $scope.options.is_show_evezplace = event.trending.is_show_evezplace;
    }

    getEvezplaceSection($scope.userId);

    $scope.addEventShowEvezplace = function () {

        usSpinnerService.spin('spinner-1');
        EventService.addEventShowEvezplace($scope.userId, $scope.eventId, $scope.options).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close("", data);
        });
    };

    $scope.$watch('options.priority',function(val,old){
        console.log(val);
        $scope.options.priority = val;
    });

    $scope.cancelShowInEvezplaceEvent = function () {
        ngDialog.close();
    }
});

