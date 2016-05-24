/**
 * Created by devcert on 12/01/15.
 */
'use strict';

evezownApp
    .controller('AdminListUsers',
    function AdminUsers($scope, $http,$routeParams, PATHS, usSpinnerService,Session, ngTableParams,$location,$rootScope,$cookieStore,ProfileDetailsService)
    {
        $scope.profile = {};
        $scope.title = "Users";
        $scope.loggedInUser = $cookieStore.get('userId');
        $scope.service_url = PATHS.api_url;
        usSpinnerService.spin('spinner-1');
        $scope.getUser = [];
        $scope.userPagination = {};

    $scope.allUsersList = function()
        {
            $http.get(PATHS.api_url + 'admin/'+$cookieStore.get('userId')+'/Allusers').
            success(function(data)
            {
                var userdatas = data.data;
                $scope.userslist = userdatas;
            });
        }
    $scope.allUsersList();

    $scope.Newsletterusers = function(){
        $rootScope.userNameArray = [];
        
        angular.forEach($scope.userslist, function(user){
          if (user.selected) $rootScope.userNameArray.push(user.email);
        });
        $cookieStore.put('NewsletterUsers', $rootScope.userNameArray);
        $location.path('/newsletterTemplate');
    }

    $scope.checkAll = function (selectedAll) {
        if (selectedAll == true) {
            $scope.selectedAll = true;
        } else {
            $scope.selectedAll = false;
        }
        angular.forEach($scope.userslist, function (user) {
            user.selected = $scope.selectedAll;

        });

    };

function fetchPersonalInfo(userId) {

            usSpinnerService.spin('spinner-1');
           
            ProfileDetailsService.getPersonalInfo(userId).then(function(data){

                usSpinnerService.stop('spinner-1');
                
                $scope.profile.profileUserId = data.user_id;
                $scope.profile.firstname = data.firstname;
                $scope.profile.lastname = data.lastname;
                $scope.profile.phone = data.phone;
                $scope.profile.email = data.email;
                $scope.profile.streetAddress = data.streetAddress;
                $scope.profile.city = data.city;
                $scope.profile.state = data.state;
                $scope.profile.country = data.country;
                $scope.profile.zip = data.zip;
                $scope.profile.education1 = data.education1;
                $scope.profile.education2 = data.education2;
                $scope.profile.education3 = data.education3;
                $scope.profile.skills = data.skills;
                $scope.profile.language1 = data.language1;
                $scope.profile.language2 = data.language2;
                $scope.profile.language3 = data.language3;
                $scope.profile.profession = data.profession;
                $scope.profile.name_organization1 = data.name_organization1;
                $scope.profile.designation1 = data.designation1;
                $scope.profile.work_experience1 = data.work_experience1;
                $scope.profile.other_info1 = data.other_info1;
                $scope.profile.userId = data.id;
            });
        }

        fetchPersonalInfo($routeParams.userId);

        /*$http.get(PATHS.api_url + 'admin/'+$cookieStore.get('userId')+'/users?page='+$routeParams.index).
            success(function(data)
            {
                $scope.users = data.data;*/
                // $scope.paging = data.meta.pagination;
                // $scope.totalPages = new Array(Number($scope.paging.total_pages));
                // $scope.active = $scope.paging.current_page;
                // $scope.next = data.meta.next;
              /*  usSpinnerService.stop('spinner-1');

                $scope.userAdminTableParams = new ngTableParams({
            page: 1,            
            count: 10           
        }, {
            total: $scope.users.length, 
            getData: function ($defer, params) {
                $defer.resolve($scope.users.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })*/

        $scope.getPersonalInfo = function(user)
        { 
            $location.path('/editUserInfo/'+user.id);
        }
        
        $scope.savePersonalInfo = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.savePersonalInfo($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message);
                $location.path('/admin/users/'+$cookieStore.get('userId'));
                //$location.path('admin/users/1');
            });
        }

        $scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentUserPage);
            $scope.GetUserPagination();
        };

        $scope.maxSize = 5;
        $scope.currentUserPage = 1;

        $scope.GetUserPagination = function () {
            $http.get(PATHS.api_url + 'admin/'+$cookieStore.get('userId')+'/users?page='+$scope.currentUserPage).
            success(function(data) {
                    console.log(data);
                    $scope.getUser = data.data;
                    usSpinnerService.stop('spinner-1');
                    $scope.userPagination = data.meta.pagination;
                }).then(function () {

                });
        }
        $scope.GetUserPagination();
        
        /**
         * This method is used to block, unblock,activate or delete a user.
         */
        $scope.userAction = function (userId,actionItem,action,userName) {
        	var actionConfirn = true;
        	if(action == "blocked"){
        		actionConfirn = confirm("Are you sure you want to block the user, "+userName+"?");
        	}else if(action == "deleted"){
        		actionConfirn = confirm("Are you sure you want to delete the user, "+userName+"?");
        	}
        	
        	if(actionConfirn){
        				usSpinnerService.spin('spinner-1');
        				$http.post(PATHS.api_url + 'admin/'+$cookieStore.get('userId')+'/users/userAction'
                         , {
                             data: {
                                 user_id: userId,
                                 action_item: actionItem,
                                 action: action,
                             },
                             headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                         }).success(function (data, status, headers, config) {
                             toastr.success(data.message);
                             usSpinnerService.stop('spinner-1');
                         }).error(function (data) {
                             usSpinnerService.stop('spinner-1');
                             toastr.error(data.error.message);
                         }).then(function(data){
                        	 $scope.GetUserPagination();
                         });
        	}
        }

});

evezownApp
    .controller('AdminAddUser',
        function ($scope, $http,$routeParams, PATHS, usSpinnerService,Session,$location,$cookieStore)
        {

            $scope.title = "Add New User";
            usSpinnerService.spin('spinner-1');
            $scope.master = {};


            $scope.saveUserInfo= function (user) {
                $scope.master = angular.copy(user);

                if (!$scope.master.firstname) {
                    toastr.error("Please enter the first name", 'Register');
                }
                else if (!$scope.master.lastname) {
                    toastr.error("Please enter the last name", 'Register');
                }
                else if (!$scope.master.emailId) {
                    toastr.error("Please enter a valid email id", 'Register');
                }
                else if(!$scope.role)
                {
                    toastr.error("Please select a member type", 'Register');
                }
                else if (!$scope.master.password) {
                    toastr.error("Password cannot be empty", 'Register');
                }
                else if (!$scope.master.cpassword) {
                    toastr.error("Password cannot be empty", 'Register');
                }
                else if (!$scope.master.password.trim()) {
                    toastr.error("Password cannot be empty", 'Register');
                }
                else if (!$scope.master.cpassword.trim()) {
                    toastr.error("Password cannot be empty", 'Register');
                }
                else if ($scope.master.password != $scope.master.cpassword) {
                    toastr.error("Confirm password do not match", 'Register');
                }
                else {
                    usSpinnerService.spin('spinner-1');
                    $http.post(PATHS.api_url + 'admin/'+$cookieStore.get('userId')+'/users/add_new_user'
                        , {
                            data: {
                                firstname: $scope.master.firstname,
                                lastname: $scope.master.lastname,
                                email: $scope.master.emailId,
                                password: $scope.master.password,
                                role: $scope.role
                            },
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        }).success(function (data, status, headers, config) {
                            toastr.success(data.message);
                            usSpinnerService.stop('spinner-1');
                            $location.path('/admin/users/'+$cookieStore.get('userId'));

                        }).error(function (data) {
                            usSpinnerService.stop('spinner-1');
                            toastr.error(data.error.message);
                        });
                }
            }


 });