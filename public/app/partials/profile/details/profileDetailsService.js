evezownApp.factory('ProfileDetailsService', ['$http', '$q', 'PATHS' ,function ($http, $q, PATHS){

    ProfileDetailsService = {};

    ProfileDetailsService.getPersonalInfo = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/personal_info')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.savePersonalInfo = function ($profile) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/personal_info/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.getEnhancedProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/enhanced_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveEnhancedProfile = function ($profile) {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/enhanced_profile/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveInterestProfile = function ($profile) {
        var deferred = $q.defer();
        //alert($profile);
        $http.post(PATHS.api_url +  'users/interest_profile/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }
    ProfileDetailsService.getInterestProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/interest_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.getOnlineProfile = function ($userId) {
        var deferred = $q.defer();

        $http.get(PATHS.api_url +  'users/' + $userId + '/online_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveOnlineProfile = function($profile) {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/online_profile/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }
    
    ProfileDetailsService.getReferenceProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/reference_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveReferenceProfile = function($profile) {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/reference_profile/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveOtherServicesProfile = function($profile) {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/other_services_profile/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.savePartneringProfile = function($profile)
    {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/partnering_profile/save', $profile)
            .success(function(data)
            {
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveFeedbackProfile = function($profile) {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/feedback/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    //saveFeedbackProfile
    //getPartneringProfile

    //getOtherServicesProfile

    ProfileDetailsService.getPartneringProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/partnering_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.getOtherServicesProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/other_services_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }


    ProfileDetailsService.getFeedbackProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/feedback')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    //savePartneringProfile

    ProfileDetailsService.getParticipationProfile = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId + '/participation_profile')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ProfileDetailsService.saveParticipationProfile = function($profile) {
        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'users/participation_profile/save', $profile)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    return ProfileDetailsService;

}]);