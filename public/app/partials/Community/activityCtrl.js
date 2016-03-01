'use strict';


evezownApp.controller('activity' ,function($scope, PATHS,$cookieStore,$http,$rootScope,$location,$routeParams,friendsService,Lightbox)
{
    $scope.caption = true;
    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.selectedActivity = [];
    $scope.groupActivityGrade;
    $scope.isFromProfile = $routeParams.isProfile;
    if($routeParams.id != undefined)
    {
        $scope.currentUserId = $routeParams.id;
    }
    else
    {
        $scope.currentUserId = $scope.loggedInUserId;
    }

    $scope.DeleteClick = function(comment)
    {
        $http.get(PATHS.api_url + 'users/groups/activities/comment/'+comment.id+'/delete')
            .
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');

            }).then(function()
            {
                $scope.GetActivityById();
            });
    }

    $scope.GetActivityById = function()
    {
        $http.get(PATHS.api_url + 'users/groups/activities/'+$routeParams.actId).
            success(function (data)
            {
                console.log(data.data);
                $rootScope.selectedActivity = data.data;
                $scope.groupActivityGrade = $rootScope.selectedActivity.scale;
            });
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

    $scope.CreateComment = function(groupActivityId)
    {
        //users/groups/activities/comment/add
        $http.post($scope.service_url + 'users/groups/activities/comment/add'
            , {
                data:
                {
                    comment: $scope.addedcomment,
                    user_id:$cookieStore.get('userId'),
                    group_activity_id:groupActivityId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Forum');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Forum');

            }).then(function()
            {
                $scope.addedcomment = "";
                $scope.GetActivityById();
            });
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

    $scope.GetActivityById();

});
