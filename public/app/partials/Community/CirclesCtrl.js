'use strict';


evezownApp.controller('circles' ,function($scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$rootScope,$routeParams,$location)
{
    $scope.caption = true;

    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.allCircles = [];
    $rootScope.selectedCircle = "";
    $rootScope.myCircles = [];
    $scope.visibilties = [];
    $scope.friendList = [];
    $scope.selectedVisibility = null;
    $rootScope.showVisibility = "";
    $scope.currentVisibility = "";
    $scope.isActive = ['', 'active', '', ''];

    

    $scope.fetchFriends = function()
    {
        //PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/circlefriends'
        $http.get(PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/'+$routeParams.circle_id+'/circlefriends').
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

    $scope.GetCirclesByUser = function()
    {
        //users/{id}/circles
        if($routeParams.id != undefined)
        {
            $scope.currentUserId = $routeParams.id;
        }
        else
        {
            $scope.currentUserId = $scope.loggedInUserId;
        }

        $http.get($scope.service_url + 'users/'+$scope.currentUserId+'/circles').
            success(function (data, status, headers, config)
            {
                $rootScope.myCircles = data.data;
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.GetAllCircles = function()
    {
        //users/{id}/circles
        $http.get($scope.service_url + 'users/circles/all').
            success(function (data, status, headers, config)
            {
                $rootScope.allCircles = data.data;
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.CreateCircle = function()
    {
        ngDialog.open({ template: 'templateId' });
    }

    $scope.EditCircle = function()
    {
        ngDialog.open({ template: 'EdittemplateId' });
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
                }
            });
    }

    $scope.GetCircleVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($rootScope.selectedCircle.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
                $rootScope.showVisibility = value;
            }
        });
    }


    $scope.UpdateCircle = function(selectedCircle)
    {
        if(!$scope.selectedCircle.title)
        {
            toastr.error("Please enter title", 'Circle');
        }
        else if(!$scope.selectedCircle.description)
        {
            toastr.error("Please enter description", 'Circle');
        }
        else
        {
            $http.post($scope.service_url + 'users/circles/update'
                , {
                    data:
                    {
                        title: selectedCircle.title,
                        description:selectedCircle.description,
                        user_id:$cookieStore.get('userId'),
                        visibility_id: $scope.selectedVisibility.id,
                        circle_id : selectedCircle.id

                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Circles');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Circles');
                }).then(function()
                {
                    $scope.GetCircleBasedOnId($routeParams.circle_id);
                });
        }
    }

    $scope.SaveCircle = function()
    {
        if(!$scope.circle)
        {
            toastr.error("Please enter title", 'Circle');
        }
        else if(!$scope.description)
        {
            toastr.error("Please enter description", 'Circle');
        }
        else
        {
            $http.post($scope.service_url + 'users/circles/create'
                , {
                    data:
                    {
                        title: $scope.circle,
                        description:$scope.description,
                        user_id:$cookieStore.get('userId'),
                        visibility_id: $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Circles');
                    $scope.Circle_Id = data.id;

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Circles');
                }).then(function()
                {
                    var Circle_ID = $scope.Circle_Id;
                    $location.path('/circle/details/'+Circle_ID);
                    //$location.path('/circles');
                    //$scope.GetCirclesByUser();
                });
        }
    }

    $scope.$watch('myCircles', function(newvalue,oldvalue)
    {
        if(oldvalue)
        {
            if(oldvalue != newvalue)
            {
                $rootScope.myCircles = newvalue;
            }
        }
    });
    $scope.$watch('selectedVisibility', function(newvalue,oldvalue)
    {
        //$rootScope.showVisibility = newvalue;
    });

    $scope.DeleteFriendFromCircle = function(circle,friendId)
    {
        $http.post($scope.service_url + 'users/circles/remove_friend'
            , {
                data:
                {
                    circle_id: circle.id,
                    friend_user_id:friendId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Circles');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Circles');
            }).then(function()
            {
                $scope.GetCircleBasedOnId($routeParams.circle_id);
            });
    }

    $scope.DeleteCircle = function(circle)
    {
        $http.get($scope.service_url + 'users/circles/'+circle.id+'/delete').
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Circles');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Circles');
            }).then(function()
            {
                $location.path('/circles');
                $scope.GetCirclesByUser();
            });
    }


    $scope.GetCircleBasedOnId = function(circleId)
    {
        $http.get($scope.service_url + 'users/circles/'+circleId).
            success(function (data, status, headers, config)
            {
                $rootScope.selectedCircle = data.data;
            }).error(function (data)
            {

            }).then(function()
            {
                $scope.fetchFriends();
                $scope.GetCircleVisibility();
            });
    }

    $scope.AddFriendsToCircle = function(friend)
    {
        $http.post($scope.service_url + 'users/circles/add_friend'
            , {
                data:
                {
                    circle_id: $routeParams.circle_id,
                    friend_user_id:friend.friend_user_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Circles');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Circles');
            }).then(function()
            {
                $scope.GetCircleBasedOnId($routeParams.circle_id);
            });
    }



    //users/circles/{circle_id}/delete
    //users/circles/{circle_id}
    $scope.fetchFriends();
    $scope.GetVisibility();
    $scope.GetCircleBasedOnId($routeParams.circle_id);
   // $scope.GetAllCircles();
    $scope.GetCirclesByUser();
});