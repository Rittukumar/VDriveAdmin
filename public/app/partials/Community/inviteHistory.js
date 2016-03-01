'use strict';


evezownApp.controller('inviteHistory' ,function($scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$rootScope,$routeParams,$location)
{
    $scope.caption = true;
    $scope.checktext = "some text";
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.getInvites = [];

    $scope.maxSize = 5;
    $scope.currentInvitePage = 1;

    $scope.GetInvitePagination = function () {
            $http.get(PATHS.api_url + 'users/' + $cookieStore.get('userId') +'/invites?page='+$scope.currentInvitePage).
            success(function(data) {
                    console.log(data);
                    $scope.getInvites = data.data;
                    $scope.invitePagination = data.meta.pagination;
                }).then(function () {

                });
    }
    $scope.GetInvitePagination ();

    $scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentInvitePage);
            $scope.GetInvitePagination ();
    }
});