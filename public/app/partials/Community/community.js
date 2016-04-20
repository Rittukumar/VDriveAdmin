'use strict';


evezownApp.controller('community' ,function($rootScope, $scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$routeParams)
{
        $scope.caption = true;
        $scope.carouselTitle = "Evezown";
        $scope.service_url = PATHS.api_url;

        //$scope.currentUserId = $cookieStore.get('userId');
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.currentUserId  = $routeParams.id;
    if ($routeParams.id != undefined) {
        $scope.currentUserId = $routeParams.id;
    }
    else {
        $scope.currentUserId = $scope.loggedInUserId;
    }

    $rootScope.loggedInUserId    = $cookieStore.get('userId');
    $rootScope.UserOnlinestatus  = '';
    $rootScope.friendList        = '';

    $scope.GetProfileImage = function(member)
    {
        ////http://creativethoughts.co.in/evezown/api/public/v1/users/{user_id}/profile_image/current
        //$http.get($scope.service_url + 'users/'+member.id+'/profile_image/current').
        //    success(function (data, status, headers, config)
        //    {
        //        member.profileImage = data;
        //    })
        //    .error(function (data)
        //    {
        //        console.log(data);
        //    });
    }
    
    $scope.fetchFriends = function()
    {
        $http.get(PATHS.api_url + 'users/' + $scope.loggedInUserId + '/friends')
            .success(function (data)
            {
                    $rootScope.friendList = data.data;
            })
            .error(function (err)
            {
                console.log('Error retrieving friends');

            }).then(function (data)
            {
                $scope.fetchMembers("");
            });
    }


    $scope.getUserOnlineStatus = function()
    {
        $http.get(PATHS.api_url + 'chat/' + $scope.loggedInUserId + '/status')
            .success(function (data)
            { 
                $rootScope.UserOnlinestatus = data;
            });
    }
    

    $scope.fetchMembers = function(searchkey)
    {
        $scope.NoResult = true;
        $http.post($scope.service_url + 'users/members/search'
            , {
                data: {
                    api_key: $cookieStore.get('api_key'),
                    search_key: searchkey
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.members = data.data;

                if($scope.members.length > 0)
                {
                    $scope.NoResult = false;
                }

            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.ConnectMember = function(member)
    {
        $http.post($scope.service_url + 'users/friend/request'
            , {
                data: {
                    user_id: $cookieStore.get('userId'),
                    friend_user_id: member.user_id
                    //friend_user_id: member.id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Community success');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Community failure');
            });
    }
    $scope.GetMemberRequest = function()
    {
        $http.get($scope.service_url + 'users/'+$cookieStore.get('userId')+'/friend/requests').
            success(function (data, status, headers, config)
            {
                $scope.memberRequests = data.data;
                angular.forEach($scope.members, function (value, key)
                {
                    var imagePath = $scope.service_url + 'users/'+value.requester_user_id+'/profile_image/current';
                    $http.get(imagePath).
                        success(function (data, status, headers, config)
                        {
                            value['profileImage1'] = data;
                        }).error(function (data)
                        {
                            console.log(data);
                        });

                });
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.AcceptRequest = function(request)
    {
        $http.post($scope.service_url + 'users/friend/request/accept'
            , {
                data: {
                    invite_id: request.id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.fetchFriends();
                $scope.GetMemberRequest();
                toastr.success(data.message, 'Community');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Community');
            });
    }
    $scope.RejectRequest = function(request)
    {
        $http.post($scope.service_url + 'users/friend/request/reject'
            , {
                data: {
                    invite_id: request.id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.fetchFriends();
                $scope.GetMemberRequest();
                toastr.success(data.message, 'Community');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Community');
            });
    }

    //take a tour
    $scope.IntroOptions = {
            steps:[
                {
                    element: '#step1',
                    //intro: "<b>&#10004;</b> Invite your friends to EvezOwn <br><b>&#10004;</b> Send invite code over email or through phone (SMS or What’sAPP)"
                    intro: "<b>&#10004;</b> Create your professional site here <br><b>&#10004;</b> Create your profile in depth. Interest, activities, achievements, talents, skills ect.."
                },
                {
                    element: '#step2',
                    //intro: "<b>&#10004;</b>Connect with your friends and other people. Invite them to join Evezown <br><b>&#10004;</b> Segregate your friends into circles, name the circles and set the visibility(privacy setting)",
                    intro: "<b>&#10004;</b> Build your professional community <br><b>&#10004;</b> Connect with your friends, collegues..",
                },
                {
                    element: '#step3',
                    intro: '<b>&#10004;</b> Invite your friends to EvezOwn <br><b>&#10004;</b> Send invite code over email or through phone (SMS or What’sAPP)',
                    position: 'bottom'
                },
                {
                    element: '#step4',
                    intro: '<b>&#10004;</b> Checkout the invite history <br><b>&#10004;</b>  Manage the invites'
                },
                {
                    element: '#step5',
                    intro: '<b>&#10004;</b> Create your personal friends circle <br><b>&#10004;</b> Segregate your friends into circles, name the circles and set the visibility(privacy setting)'
                },
                {
                    element: '#step6',
                    intro: "<b>&#10004;</b> Advertise through this channel <br><b>&#10004;</b> Send invites to your friends in contact list",
                    position: 'bottom'
                },
                {
                    element: '#step7',
                    intro: '<b>&#10004;</b> Explore the two sections Marketplace and Jobs'
                },
                {
                    element: '#step8',
                    intro: '<b>&#10004;</b> Use search feature to find what you are looking for <br><b>&#10004;</b> Search by key word,type of post, category, subcategory, brand, price or location'
                }
            ],
            showStepNumbers: false,
            exitOnOverlayClick: true,
            exitOnEsc:true,
            nextLabel: '<strong>NEXT!</strong>',
            prevLabel: '<span style="color:green">Previous</span>',
            skipLabel: 'Exit',
            doneLabel: 'Thanks'
        };

        $scope.ShouldAutoStart = false;
        //take a tour ends


        $scope.fetchFriends();
        $scope.GetMemberRequest();
        $scope.getUserOnlineStatus();

});