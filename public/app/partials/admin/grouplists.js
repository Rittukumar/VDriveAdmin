
'use strict';

evezownApp
    .controller('grouplists',
    function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService,Session,ngDialog,$rootScope,$cookieStore,ngTableParams,GroupService, $controller)
    {
    $scope.groups = [];
    $scope.service_url = PATHS.api_url;
    //$rootScope.currentGroup = null;
    $scope.selectedVisibility = null;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.title = "Groups";
    usSpinnerService.spin('spinner-1');
    $http.get(PATHS.api_url  + 'users/groups/all').
    success(function(data)
    {
        $scope.groups = data.data;
        usSpinnerService.stop('spinner-1');

        $scope.groupAdminTableParams = new ngTableParams({
        page: 1,            // show first page
        count: 10           // count per page
        }, {
        total: $scope.groups.length, // length of data
        getData: function ($defer, params) {
        $defer.resolve($scope.groups.slice((params.page() - 1) * params.count(), params.page() * params.count()));
        }
        })

        $scope.EditGroup = function(selectedGroup)
        { 
            $rootScope.currentGroup = selectedGroup;
            ngDialog.open({ template: 'EdittemplateId' });
        }

        $scope.$watch('currentGroup', function(newValue,oldValue)
        {
            $rootScope.currentGroup = newValue;
            $scope.GetVisibility();
        });

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
                if($rootScope.currentGroup.visibility_id == value.id)
                {
                    //alert(value.id);
                    $scope.selectedVisibility = value;
                    $rootScope.showVisibility = value;
                }
            });
        }


        $scope.UpdateGroup= function(selectedGroup)
        { 
            //alert($scope.selectedVisibility.id);
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


        function fetchGroups() {
            usSpinnerService.spin('spinner-1');
            GroupService.getGroups().then(function (data) {

                usSpinnerService.stop('spinner-1');

                $scope.groups = data;
            });
        }

        fetchGroups();

        $scope.DeleteGroupDialog = function(id)
        {
            var deleteGroupDialog = ngDialog.open(
                {
                    template: 'deleteGroupTemplateId',
                    scope: $scope,
                    controller: $controller('deleteGroupCtrl', {
                        $scope: $scope,
                        groupId: id
                    })
                });

            deleteGroupDialog.closePromise.then(function (data) {

                if(data.value.status) {
                    toastr.success(data.value.message, 'Group deleted');
                    fetchGroups();
                }    
            });
        }
    });
});

evezownApp.controller('deleteGroupCtrl', function($scope, GroupService, $cookieStore,
                                                    usSpinnerService, groupId, ngDialog) {
    console.log(groupId);

    // Delete Group item
    $scope.groupId = groupId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteGroup = function () {
        usSpinnerService.spin('spinner-1');
        GroupService.deleteGroup($scope.userId, $scope.groupId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close("", data);
        });
    }

    $scope.cancelDeleteGroup = function() {
        ngDialog.close();
    }
});
