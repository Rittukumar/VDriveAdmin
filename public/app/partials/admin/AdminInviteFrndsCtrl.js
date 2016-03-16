'use strict';

evezownApp.filter('offset', function () {
    return function (input, start) {
        if (input != null) {
            start = parseInt(start, 10);
            return input.slice(start);
        }
    };
});

evezownApp.controller('AdminInviteFrndsCtrl', function ($scope, Facebook, $linkedIn,
                                                     $cookieStore, $http, PATHS, $auth, AuthService) {

    $scope.sectionTitle = "Invite Friends";
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.email = $cookieStore.get('email');
    $scope.linkedinConnections = [];
    $scope.friendslist = [];
    $scope.loggedInUserEmail = null;

    $scope.emailList = "";
    $scope.gpAccessToken = "";

    $scope.currentPage = 0;
    $scope.itemsPerPage = 15;
    $scope.itemsPerPage1 = 15;
    $scope.currentPage1 = 0;

    $scope.selected = 'GP';

    function getLoggedInUser () {
        AuthService.getUser().then(function (data) {
            $scope.loggedInUserEmail = data.email;
            $scope.whatsAppDescription = "Hi, " +

                "Have a look at Evezown.com. " +
                "Evezown.com is a space for people like you to interact and transact, voice opinion and showcase your" +
                " unique identity, personality, talent and  business..." +
                "everything that defines you. " +

                "Please press create sign up invite for registration, You can give my email id " +  $scope.loggedInUserEmail +
                " as reference id. I have already registered as a member. " +

                "Look forward to meeting you inside Evezown.com";
        });
    }

    getLoggedInUser();

    $scope.range = function () {
        var rangeSize = 5;
        var ret = [];
        var start;
        start = $scope.currentPage;
        if (start > $scope.pageCount() - rangeSize) {
            start = $scope.pageCount() - rangeSize + 1;
        }

        for (var i = start; i < start + rangeSize; i++) {
            ret.push(i);
        }
        return ret;
    };

    $scope.getEmail = function ($userId) {
        $http.get(PATHS.api_url + 'users/' + $userId)
            .success(function (data) {
                $scope.EmailID = data.data.email;
                $scope.Content1 = "Have a look at Evezown.com";
                $scope.Content2 = "Evezown.com is a space for people like you to interact and transact, voice opinion and showcase your unique identity, personality, talent and  business…....everything that defines you.";
                $scope.Content3 = "Please press create sign up invite for registration, You can give my email id " + $scope.EmailID + " as reference id. I have already registered as a member.";
                $scope.Content4 = "Look forward to meeting you inside:";
            })
            .error(function (err) {
                console.log('Error retrieving user');
            });
    }



    $scope.range1 = function () {
        var rangeSize = 5;
        var ret = [];
        var start;

        start = $scope.currentPage1;
        if (start > $scope.pageCount1() - rangeSize) {
            start = $scope.pageCount1() - rangeSize + 1;
        }

        for (var i = start; i < start + rangeSize; i++) {
            ret.push(i);
        }
        return ret;
    };

    $scope.prevPage = function () {
        if ($scope.currentPage > 0) {
            $scope.currentPage--;
        }
    };

    $scope.prevPage1 = function () {
        if ($scope.currentPage1 > 0) {
            $scope.currentPage1--;
        }
    };

    $scope.prevPageDisabled1 = function () {
        return $scope.currentPage1 === 0 ? "disabled" : "";
    };

    $scope.prevPageDisabled = function () {
        return $scope.currentPage === 0 ? "disabled" : "";
    };

    $scope.pageCount1 = function () {
        // var friendsArray = $scope.friendslist;
        if ($scope.friendslist != null)
            return Math.ceil($scope.friendslist.length / $scope.itemsPerPage1) - 1;
        else
            return 0;
    };

    $scope.pageCount = function () {
        // var friendsArray = $scope.linkedinConnections;
        if ($scope.linkedinConnections != null)
            return Math.ceil($scope.linkedinConnections.length / $scope.itemsPerPage) - 1;
        else
            return 0;
    };

    $scope.nextPage1 = function () {
        if ($scope.currentPage1 < $scope.pageCount1()) {
            $scope.currentPage1++;
        }
    };

    $scope.nextPage = function () {
        if ($scope.currentPage < $scope.pageCount()) {
            $scope.currentPage++;
        }
    };

    $scope.nextPageDisabled1 = function () {
        return $scope.currentPage1 === $scope.pageCount1() ? "disabled" : "";
    };

    $scope.nextPageDisabled = function () {
        return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
    };

    $scope.setPage = function (n) {
        $scope.currentPage = n;
    };

    $scope.setPage1 = function (n) {
        $scope.currentPage1 = n;
    };


    $scope.login = function () {
        // From now on you can use the Facebook service just as Facebook api says
        Facebook.login(function (response) {

        });
    };

    $scope.getLoginStatus = function () {
        Facebook.getLoginStatus(function (response) {
            if (response.status === 'connected') {
                $scope.loggedIn = true;
            } else {
                $scope.loggedIn = false;
            }
        });

        return $scope.loggedIn;
    };

    $scope.me = function () {
        Facebook.api('/me', function (response) {
            $scope.user = response;
        });
    };

    //$scope.sendFacebookRequests = function ()
    //{
    //    FB.ui({
    //        method: 'apprequests',
    //        message: 'http://evezown.com/app/#/signup'
    //    }, function(response)
    //    {
    //        if (response != null && response.request_ids && response.request_ids.length > 0) {
    //            for (var i = 0; i < response.request_ids.length; i++) {
    //                alert("Invited: " + response.request_ids[i]);
    //            }
    //        } else {
    //            alert('No invitations sent');
    //        }
    //    });
    //};


    $scope.sendFacebookRequests = function () {
        //FB.getLoginStatus(function(response)
        //{
        //    if (response.status === 'connected')
        //    {

        var loggedIn = $scope.getLoginStatus();

        if (loggedIn) {
            $scope.ShowRequestWindow();
        }
        else {
            $scope.LoginFacebook();
        }

    }


    $scope.LoginFacebook = function () {
        Facebook.login(function (response) {
            alert(response.authResponse);
            $scope.ShowRequestWindow();
        }, {scope: 'email,user_likes,publish_actions'});
    }


    $scope.ShowRequestWindow = function () {
        //if (response.authResponse)
        //{
        //var post_options = {
        //    method: 'apprequests',
        //    display: 'iframe',
        //    message: "Invitation join evezown",
        //    data: "http://evezown.com/beta1/#/requestinvite",
        //    title: "Evezown"
        //};
        //
        //FB.ui(post_options,function(response)
        //    {
        //        console.log(response)
        //       // alert(response);
        //        if (response && response.request_ids)
        //        {

        var message = "Hi <\"br>";

        message += "I would like to invite you to join www.evezown.com <\"br>";

        message += "Once you register as a member, you can use the Mysite section to create your profile and use features like blogs, groups, events, ads & campaigns, discussion, for interacting with your friends and circle of friends who are also members on evezown. You can open a store for your product or business service in our MarketPlace or if you are a working professional, simply search and find the career of your choice in Jobs.<\"br>";

        message += "Click here to register http://evezown.com/#/requestinvite. (please put the actual link here)<\"br>";
        message += "Make EvezOwn.com your own place.<\"br>";
        FB.ui({
                method: 'send',
                name: 'Invitation from evezown',
                link: 'http://evezown.com/',
                description: message,
                picture: 'http://evezown.com/img/logo.png'
            },
            function (response) {
                if (response && response.post_id) {
                    toastr.success('Post was published.', 'Invite Friends');
                }
                //else
                //{
                //    alert('Post was not published.');
                //}
            }
        );
        //            alert('Notification Sent!');
        //        }
        //    }
        //);
        //}

    }

    $scope.GetConnections = function () {

        IN.API.Connections("me")
            .result(function (result) {
                $scope.$apply(function () {
                    $scope.linkedinConnections = result.values;

                });
            })
            .error(function () {
                $scope.$apply(function () {
                    $scope.linkedinConnections = null;
                    alert("No connections available");
                });
            });
    }
    $scope.getLinkedinConnections = function () {
        $scope.selected = 'LI';
        //var isAuthorized = $linkedIn.isAuthorized();
        //alert(isAuthorized);
        if (!IN.User.isAuthorized()) {
            IN.User.authorize().place();
            $scope.GetConnections();
        }
        else {
            $scope.GetConnections();
        }
    };


    $scope.SendLinkedInvite = function (memberConnection) {
        var subject = 'Invitation join evezown';
        var body = 'http://evezown.com/#/requestinvite';
        var BODY = {
            "recipients": {
                "values": [
                    {
                        "person": {
                            "_path": "/people/" + memberConnection.id
                        }
                    }]
            },
            "subject": subject,
            "body": body
        }
        IN.API.Raw("/people/~/mailbox") // Unset (DELETE) the status
            .method("POST")
            .body(JSON.stringify(BODY))
            .result(function (result) {
                toastr.success("Invite sent successfully", 'Linkedin');
            })
            .error(function (error) {
                toastr.error("Sending Invite failed. Please try again later!", 'Linkedin');
            });
        //https://api.linkedin.com/v1/people/~/mailbox
        //alert(memberConnection);
    }
    // Reset the linkcedin collection and hide the table.
    $scope.resetLinkedin = function () {

        $scope.linkedinConnections = null;
        $scope.query = "";
        $scope.selected = '';
    }

    $scope.resetGooglePlus = function () {
        //gapi.auth.signOut();
        //$scope.start();
        $scope.friendslist = [];
        $scope.selected = '';
    }

    $scope.GetGoogleUserList = function () {
        if (GoogleService.login()) {
            alert('loggedIn');
        }
        else {
            alert('not loggedIn');
        }
    }
    // This flag we use to show or hide the button in our HTML.
    $scope.signedIn = false;

    // Here we do the authentication processing and error handling.
    // Note that authResult is a JSON object.
    $scope.processAuth = function (authResult) {
        if (!$scope.signedIn) {
            // Do a check if authentication has been successful.
            if (authResult['access_token']) {
                // Successful sign in.
                $scope.signedIn = true;
                $scope.gpAccessToken = authResult;
                $scope.getUserInfo($scope.gpAccessToken);


                //     ...


                // Do some work [1].
                //     ...
            } else if (authResult['error']) {
                // Error while signing in.
                $scope.signedIn = false;
                // Report error.
            }
        }
        else {
            $scope.getUserInfo($scope.gpAccessToken);
        }

    };

    // When callback is received, we need to process authentication.
    $scope.signInCallback = function (authResult) {
        $scope.$apply(function () {
            $scope.processAuth(authResult);
        });
    };

    // Render the sign in button.
    $scope.renderSignInButton = function () {
        gapi.signin.render('signInButton',
            {
                'callback': $scope.signInCallback, // Function handling the callback.
                'clientid': '62262746490-1q3ga3dh20r5bmu9taccvj4ohmoimp54.apps.googleusercontent.com', // CLIENT_ID from developer console which has been explained earlier.
                'requestvisibleactions': 'http://schemas.google.com/AddActivity', // Visible actions, scope and cookie policy wont be described now,
                                                                                  // as their explanation is available in Google+ API Documentation.
                'scope': 'https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.email https://www.google.com/m8/feeds https://www.googleapis.com/auth/contacts.readonly',
                'cookiepolicy': 'single_host_origin'
            }
        );
    }

    // Process user info.
// userInfo is a JSON object.
    $scope.processUserInfo = function (userInfo) {
        // You can check user info for domain.
        if (userInfo['domain'] == 'mycompanydomain.com') {
            // Hello colleague!
        }

        // Or use his email address to send e-mails to his primary e-mail address.
        sendEMail(userInfo['emails'][0]['value']);
    }

// When callback is received, process user info.
    $scope.userInfoCallback = function (userInfo) {
        $scope.$apply(function () {
            $scope.processUserInfo(userInfo);
        });
    };

// Request user info.
    $scope.getUserInfo = function (data) {
        //var request = null;
        //var request = gapi.client.request({
        //    'path': '/plus/v1/people/me/people/visible?access_token='+accessToken,
        //    'method': 'GET',
        //    'params': {'maxResults': '100'}
        //});
        //request.execute(function(jsonResp, rawResp) {
        //    console.log(jsonResp);
        //    $scope.friendslist = jsonResp.items;
        //    //$scope.friendslist['email'] = jsonResp.emails[0].value;
        //    $scope.$apply();
        //});
        var firstname = "";
        var givenname = "";
        var emailId = "";
        var phonenumber = "";
        var familyname = ""
        var data1 = [];
        gapi.client.load('oauth2', 'v2', function () {
            var request = gapi.client.oauth2.userinfo.get();
            request.execute(function (resp) {
                data1.push(resp.email);
                data1.push(data.access_token);

                $http.get("https://www.google.com/m8/feeds/contacts/" + data1[0] + "/full?alt=json&access_token=" + data1[1] + "&max-results=1000&v=3.0")
                    .success(function (data, status, headers, config) {

                        var list = [];
                        var log = [];
                        var counter = 0;
                        angular.forEach(data['feed']['entry'], function (value, key) {
                            if (value.hasOwnProperty("gd$email") && value.hasOwnProperty("gd$name")) {
                                if (value.hasOwnProperty('gd$name')) {
                                    if (value['gd$name'].hasOwnProperty('gd$fullName')) {
                                        firstname = value['gd$name']['gd$fullName']['$t'];
                                    }
                                    else {
                                        firstname = "";
                                    }
                                    if (value['gd$name'].hasOwnProperty('gd$givenName')) {
                                        givenname = value['gd$name']['gd$givenName']['$t'];
                                    }
                                    else {
                                        givenname = "";
                                    }
                                    if (value['gd$name'].hasOwnProperty('gd$familyName')) {
                                        familyname = value['gd$name']['gd$familyName']['$t'];
                                    }
                                    else {
                                        familyname = "";
                                    }
                                }


                                if (value.hasOwnProperty("gd$email")) {
                                    if (value['gd$email'][0].hasOwnProperty('address')) {
                                        emailId = value['gd$email'][0]['address'];
                                    }
                                    else {
                                        emailId = "";
                                    }
                                }
                                else {
                                    emailId = "";
                                }
                                if (value.hasOwnProperty('gd$phoneNumber')) {
                                    if (value['gd$phoneNumber'][0]) {
                                        phonenumber = value['gd$phoneNumber'][0]['$t'];
                                    }
                                    else {
                                        phonenumber = "";
                                    }
                                }
                                else {
                                    phonenumber = "";
                                }

                                list = {
                                    "firstName": firstname,
                                    "email": emailId,
                                    "givenName": givenname,
                                    "phoneNumber": phonenumber
                                };
                                log.push(list);
                                list = {};
                                counter++;
                            }

                        }, log);
                        //console.log($scope.friendslist);

                        //$scope.friendslist.push(log);
                        //$scope.$apply();
                        //angular.forEach(log, function(value, key)
                        //{
                        //    $scope.friendslist.push(value);
                        //});

                        $scope.friendslist = log;

                        console.log($scope.friendslist);

                    })
                    .error(function (data, status, headers, config) {
                        console.log("In error");
                    });
            });
        });


        //var url =
        //    "https://www.googleapis.com/m8/feeds/contacts/default/full?oauth_token=" +
        //    accessToken +
        //    "&max-results=7000&v=3.0";
        //
        //
        //$http.get(url).
        //    success(function (data)
        //    {
        //        alert(data);
        //    });

        //var data = {};
        //gapi.client.load('oauth2', 'v2', function () {
        //    var request = gapi.client.oauth2.contacts.get();
        //    request.execute(function (resp) {
        //        data.email = resp.email;
        //    });
        //});
        //request.then(function(resp)
        //{
        //    $scope.friendslist = resp.result.items;
        //}, function(reason)
        //{
        //    console.log('Error: ' + reason.result.error.message);
        //});
    }

    // Start function in this example only renders the sign in button.
    $scope.start = function () {
        $scope.selected = 'GP';
        if (!$scope.signedIn) {
            $scope.renderSignInButton();
        }
        else {
            $scope.getUserInfo($scope.gpAccessToken);
        }
    };


    $scope.sendInvite = function (emailId) {
        var emailformat = /^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        if (!emailformat.test(emailId)) {
            toastr.error("Please enter a valid email", 'Build Community');
        }
        else {
            $http.post(PATHS.api_url + 'invite/email'
                , {
                    data: {
                        referrer_id: $cookieStore.get('userId'),
                        emailIds: emailId
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                success(function (data, status, headers, config) {
                    $scope.emailaddressArea = "";
                    toastr.success(data.message, 'Build Community');

                }).error(function (data) {
                    toastr.error(data.error.message, 'Build Community');
                });
        }

    }

    $scope.authenticate = function (provider) {
        $auth.authenticate(provider);
    }
    $scope.getEmail($scope.loggedInUserId);
    // Call start function on load.
    //  $scope.start();

});