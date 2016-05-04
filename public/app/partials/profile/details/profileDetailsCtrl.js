evezownApp
.controller('profileDetailsCtrl', function ($scope, ProfileDetailsService,$cookieStore, usSpinnerService, $http, PATHS, $routeParams,$location) {

        $scope.profile = {};

        $scope.enhancedProfile = {};

        $scope.onlineProfile = {};

        $scope.referenceProfile = {};

        $scope.other = {};

        $scope.feedback = {};

        $scope.partnering = {};

        $scope.participationProfile = {};

        $scope.favorites = {};

        $scope.isActive = ['', 'active', '', ''];

        $scope.checkforPasswordField = '';

        if($routeParams.id)
        {
            $scope.favorites.userId = $routeParams.id;
            $scope.partnering.userId = $routeParams.id;
            $scope.feedback.userId = $routeParams.id;
        }
        else
        {
            $scope.favorites.userId = $cookieStore.get('userId');
            $scope.partnering.userId = $cookieStore.get('userId');
            $scope.feedback.userId = $cookieStore.get('userId');
        }
        $scope.enhancedProfile.userId = $routeParams.id;
        $scope.onlineProfile.userId = $routeParams.id;
        $scope.referenceProfile.userId = $routeParams.id;
        $scope.participationProfile.userId = $routeParams.id;
        $scope.other.userId = $routeParams.id;


        function fetchPersonalInfo(userID) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.getPersonalInfo(userID).then(function(data){

                usSpinnerService.stop('spinner-1');
                
                $scope.profile.profileUserId = data.user_id;
                $scope.profile.firstname = data.firstname;
                $scope.profile.lastname = data.lastname;
                $scope.profile.phone1 = data.phone;
                var PhoneNumber = parseInt($scope.profile.phone1);
                $scope.profile.phone = PhoneNumber;
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
            $location.hash('view');
        }

        function fetchEnhancedProfile(userID) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.getEnhancedProfile(userID).then(function(data){

                usSpinnerService.stop('spinner-1');

                $scope.enhancedProfile.wantProfilePage = data.wantProfilePage;
                $scope.enhancedProfile.profilePageType = data.profilePageType;
                $scope.enhancedProfile.aboutme = data.aboutme;
                $scope.enhancedProfile.hobbies = data.hobbies;
                $scope.enhancedProfile.talents = data.talents;
                $scope.enhancedProfile.achievements = data.achievements;
                $scope.enhancedProfile.interests = data.interests;
                $scope.enhancedProfile.interestedInContentCreation = data.interestedInContentCreation;
                $scope.profile.needCustomizedProfilePage = data.needCustomizedProfilePage;
                $scope.enhancedProfile.needMarketingSupport = data.needMarketingSupport;
                $scope.enhancedProfile.needEnhancedProfile = data.needEnhancedProfile;
                $scope.enhancedProfile.needProfessionalWebsiteLink = data.needProfessionalWebsiteLink;
                $scope.enhancedProfile.professionalWebsiteLink = data.professionalWebsiteLink;
                $scope.enhancedProfile.resumeVisibility = data.resumeVisibility;
                $scope.enhancedProfile.userId = data.id;
            });
        }

        function fetchOnlineProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getOnlineProfile(userId).then(function (data) {
                usSpinnerService.stop('spinner-1');
                $scope.onlineProfile.facebook = data.facebook;
                $scope.onlineProfile.linkedin = data.linkedin;
                $scope.onlineProfile.website = data.website;
                $scope.onlineProfile.twitter = data.twitter;
                $scope.onlineProfile.pinterest = data.pinterest;
                $scope.onlineProfile.googlePlus = data.googlePlus;
                $scope.onlineProfile.youtube = data.youtube;
                $scope.onlineProfile.otherSocial = data.otherSocial;
                $scope.onlineProfile.ecommerce = data.ecommerce;
                $scope.onlineProfile.userId = data.id;
            });
        }

        function fetchOtherServicesProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getOtherServicesProfile(userId).then(function (data) {
                usSpinnerService.stop('spinner-1');
                $scope.other.need_wopportunity_listing = parseInt(data.need_wopportunity_listing, 10);
                $scope.other.need_resume_upload = parseInt(data.need_resume_upload,10);
                $scope.other.full_time_job = parseInt(data.full_time_job,10);
                $scope.other.part_time_job = parseInt(data.part_time_job,10);
                $scope.other.flexi_job = parseInt(data.flexi_job,10);
                $scope.other.short_assignment = parseInt(data.short_assignment,10);
                $scope.other.freelancing_job = parseInt(data.freelancing_job,10);
                $scope.other.interested_industry_sector = data.interested_industry_sector;
                $scope.other.hire_through_evezown = parseInt(data.hire_through_evezown,10);
                $scope.other.userId = data.id;
            });
        }

        function fetchReferenceProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getReferenceProfile(userId).then(function (data)
            {
                usSpinnerService.stop('spinner-1');
                if(data.name1)
                {
                    $scope.referenceProfile.reference_name1 = data.name1;
                }
                if(data.email1)
                {
                    $scope.referenceProfile.reference_email1 = data.email1;
                }
                if(data.phone1)
                {
                    var PhoneNumber1 = parseInt(data.phone1);
                    $scope.referenceProfile.reference_phone1 = PhoneNumber1;
                }
                if(data.name2)
                {
                    $scope.referenceProfile.reference_name2 = data.name2;
                }
                if(data.email2)
                {
                    $scope.referenceProfile.reference_email2 = data.email2;
                }
                if(data.phone2)
                {
                    var PhoneNumber2 = parseInt(data.phone2);
                    $scope.referenceProfile.reference_phone2 = PhoneNumber2;
                }
                if(data.name3)
                {
                    $scope.referenceProfile.reference_name3 = data.name3;
                }
                if(data.email3)
                {
                    $scope.referenceProfile.reference_email3 = data.email3;
                }
                if(data.phone3)
                {
                    var PhoneNumber3 = parseInt(data.phone3);
                    $scope.referenceProfile.reference_phone3 = PhoneNumber3;
                }
                $scope.referenceProfile.userId = data.id;
            });
        }

        function fetchParticipationProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getParticipationProfile(userId).then(function (data) {
                usSpinnerService.stop('spinner-1');
                $scope.participationProfile.doYouHavePhysicalStore = data.doYouHavePhysicalStore;
                $scope.participationProfile.doYouWantToOpenStore = data.doYouWantToOpenStore;
                $scope.participationProfile.storeFrontOnly = data.storeFrontOnly;
                $scope.participationProfile.storeWithPayment = data.storeWithPayment;
                $scope.participationProfile.needLogistics = data.needLogistics;
                $scope.participationProfile.requirePostSalesSupport = data.requirePostSalesSupport;
                $scope.participationProfile.likeSurvey = data.likeSurvey;
                $scope.participationProfile.userId = data.id;
            });
        }

        $scope.savePersonalInfo = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.savePersonalInfo($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Personal Info');
                $location.path('profile/'+$scope.profile.userId+'/enhance');
            });
        }


        function fetchInterestProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getInterestProfile(userId).then(function (data) {
                $scope.favorites.interests = data.interest;
            });
        }

        function fetchFeedbackProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getFeedbackProfile(userId).then(function (data) {
                $scope.feedback.feedback = data.feedback;
            });
        }

        function fetchPartneringProfile(userId) {
            usSpinnerService.spin('spinner_1');
            ProfileDetailsService.getPartneringProfile(userId).then(function (data)
            {
                $scope.partnering.through_blogs = parseInt(data.through_blogs, 10);
                $scope.partnering.through_forums = parseInt(data.through_forums, 10);
                $scope.partnering.through_events = parseInt(data.through_events, 10);
                $scope.partnering.through_recco = parseInt(data.through_recco, 10);
                $scope.partnering.as_woice_user = parseInt(data.as_woice_user, 10);
                $scope.partnering.as_evangelist = parseInt(data.as_evangelist, 10);
                $scope.partnering.as_active_writer = parseInt(data.as_active_writer, 10);
                $scope.partnering.as_ecommerce = parseInt(data.as_ecommerce, 10);
                $scope.partnering.interested_in_content_creation = parseInt(data.interested_in_content_creation, 10);
                $scope.partnering.other_ideas = data.other_ideas;
            });
        }

        //partnering_profile

        $scope.saveInterestInfo = function ($profile)
        {
                $http.post(PATHS.api_url + 'users/interest_profile/save'
                , {
                    data:
                    {
                        interests: $scope.favorites.interests,
                        user_id:$scope.favorites.userId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Interest Info');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Interest Info');
                }).then(function()
                {
                    $location.path('profile/'+$scope.favorites.userId+'/reference');
                });
        }

        $scope.saveEnhancedProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveEnhancedProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Enhanced Profile');
                $location.path('profile/'+$routeParams.id+'/myonline');
            });
        }

        $scope.saveOnlineProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveOnlineProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Enhanced Profile');
                $location.path('profile/favorites');
            });
        }

        $scope.saveFavorites = function ($profile)
        {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveOnlineProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Enhanced Profile');
                $location.path('profile/favorites');
            });
            toastr.success('Saved successfully', 'Enhanced Profile');
            $location.path('profile/'+$routeParams.id+'/reference');
        }

        $scope.saveReferenceProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveReferenceProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Reference Profile');
                $location.path('profile/'+$routeParams.id+'/participation');
            });
        }

        $scope.saveParticipationProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveParticipationProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Participation Profile');
                $location.path('profile/'+$routeParams.id+'/other');
            });
        }

        $scope.saveOtherServicesProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveOtherServicesProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Other services Profile');
                $location.path('profile/partnering');
            });
        }

        $scope.savePartneringProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.savePartneringProfile($profile).then(function (data)
            {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Partnering With Evezown Profile');
                $location.path('profile/feedback');
            });
        }

        $scope.saveFeedbackProfile = function ($profile) {
            usSpinnerService.spin('spinner-1');
            ProfileDetailsService.saveFeedbackProfile($profile).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Feedback');
                //$location.path('profile/feedback');
            });
        }
        
        $scope.changePassword = function (credentials)
        {
            var UserID = $routeParams.id;
            var CurrentPass = $scope.current_password;
            var NewPass = $scope.new_password;
            var ConfirmPass = $scope.confirm_password;
            
            var Check1 = /^(?=.*\d)[A-Za-z0-9\W_]{7,20}$/; /*Atleast one digit*/
            var Check2 = /^(?=.*[A-Z])[A-Za-z0-9\W_]{7,20}$/; /*Atleast one Uppercase*/
            var Check3 = /^(?=.*[\W_])[A-Za-z0-9\W_]{7,20}$/; /*Atleast one Special character*/
            var Check4 = /^(?=.*\d)[0-9]{7,20}$/; /*Only Numbers*/
            var Check5 = /^(?=.*[\W_])[\W_]{7,20}$/; /*Only Special Characters*/
            
            if (CurrentPass == undefined || NewPass == undefined || ConfirmPass == undefined)
            {
                toastr.error('All fields are mandatory');
            }
            
            else if((Check1.test(NewPass) || Check2.test(NewPass) || Check3.test(NewPass)) && (!Check4.test(NewPass) && !Check5.test(NewPass)))
            {
                if(NewPass == ConfirmPass)
                {
                    $http.post(PATHS.api_url + 'change_password/user'
                    , {
                        data: {
                            Userid: UserID,
                            current_password: CurrentPass,
                            new_password: NewPass,
                            confirm_password: ConfirmPass
                        },
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    }).success(function(data){
                        toastr.success(data);
                        $scope.current_password = "";
                        $scope.new_password = "";
                        $scope.confirm_password = "";
                    }).error(function (data) {
                        toastr.error(data.error.message);
                    });
                }
                else
                {
                    toastr.error("Password change failed. New passwords do not match");
                }
            }
            else
            {
                toastr.error('New password too weak');   
            }
            
        }


        $scope.checkforPasswordField = function(){
           var data = { user_id : $cookieStore.get('userId') };
           $http.post(PATHS.api_url + 'users/checkforPasswordField', data)
                .success(function(response){ 

                    if(response){
                      $scope.checkforPasswordField = false; 
                    }else{
                      $scope.checkforPasswordField = true; 
                    }
                    
                }).error(function (response) {
                    console.log(response);
                });

        };


        if($cookieStore.get('userId'))
        {   
            $scope.checkforPasswordField();
        }

        fetchPersonalInfo($routeParams.id);
        fetchEnhancedProfile($routeParams.id);
        fetchOnlineProfile($routeParams.id);
        fetchReferenceProfile($routeParams.id);
        fetchParticipationProfile($routeParams.id);
        fetchInterestProfile($scope.favorites.userId);
        fetchOtherServicesProfile($routeParams.id);
        fetchPartneringProfile($scope.partnering.userId);
        fetchFeedbackProfile($scope.feedback.userId);
});
