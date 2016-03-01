/**
 * Created by devcert on 12/01/15.
 */
'use strict';

evezownApp
    .controller('NewsletterCtrl',
    function AdminUsers($scope, $http,$routeParams, PATHS, usSpinnerService,Session, ngTableParams,ngDialog,$location,$rootScope,$cookieStore,ProfileDetailsService)
    {
        
        $scope.loggedInUser = $cookieStore.get('userId');
        $scope.service_url = PATHS.api_url;
        usSpinnerService.stop('spinner-1');
        $scope.NewsletterUsers = $cookieStore.get('NewsletterUsers');


    
    $scope.SendNewsletter = function(){

        var emailids = $scope.NewsletterUsers;
        if(emailids){
            var emails = emailids.toString();
        }
        var content = $scope.htmlVariable;

        if(emailids == undefined || emailids == "" )
        {
            toastr.error('Enter Valid EmailID');
        }
        else if(content == undefined || content == "")
        {
            toastr.error('Enter Valid Content');
        }
        else{
        
                $http.post(PATHS.api_url + 'newsletter/email'
                , {
                    data: {
                        message: content,
                        emailIds: emails,
                        sender_id: $cookieStore.get('userId')
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                })
            $cookieStore.remove('NewsletterUsers');
            $scope.htmlVariable="";
            $scope.NewsletterUsers="";
            toastr.success('Newsletter Send Successfully');
            }
    }
    

});