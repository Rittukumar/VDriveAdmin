'use strict';


evezownApp.controller('inviteHistory' ,function($scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$rootScope,$routeParams,$location)
{
    $scope.caption = true;
    $scope.checktext = "some text";
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.getInvites = [];

    $scope.maxSize = 5;
    $scope.currentInvitePage = 1;

    var remderInvitEmail=$rootScope.InviteMail;

    $scope.GetInvitePagination = function () {
            $http.get(PATHS.api_url + 'users/' + $cookieStore.get('userId') +'/invites?page='+$scope.currentInvitePage).
            success(function(data) {
                    console.log(data);
                    $rootScope.getInvites = data.data;
                    $scope.invitePagination = data.meta.pagination;
                }).then(function () {

                });
    }
    $scope.GetInvitePagination();

    $scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentInvitePage);
            $scope.GetInvitePagination();
    }
    
    $scope.InviteDelete = function (email) {
        
        $cookieStore.put('InviteMail',email);
        ngDialog.open({template: 'DeleteHistory'});
    }

    $scope.CancelDeleteInvite = function () {
        
        $cookieStore.remove('InviteMail');
        ngDialog.close();
    }
    

    //Resend invite
    $scope.ResendInvite = function (emailId) {


        $scope.emails = emailId;

            $http.post(PATHS.api_url + 'invite/remainder'
            , {
                data: {
                    referrer_id: $cookieStore.get('userId'),
                    emailIds: $scope.emails
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
               
                toastr.success(data.message, 'Invite');
                $scope.GetInvitePagination();
                
            }).error(function (data) {
                toastr.error(data.error.message, 'Build Community');
            });

    }

    //Delete invite
    $scope.DeleteInvite = function () {

        var Email = $cookieStore.get('InviteMail');
            
           $http.post(PATHS.api_url + 'invite/delete'
            , {
                data: {
                    referrer_id: $cookieStore.get('userId'),
                    emailIds: Email
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
                toastr.success(data.message, 'Invite');
                ngDialog.close();
                $cookieStore.remove('InviteMail');
                $scope.GetInvitePagination();
                
            }).error(function (data) {
                toastr.error(data.error.message, 'Build Community');
            });
    }
});