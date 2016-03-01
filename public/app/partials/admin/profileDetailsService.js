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

    
    return ProfileDetailsService;

}]);