/**
 * @ngdoc service
 * @name evezownapp.profileService
 * @description
 * _Please update the description and dependencies._
 *
 * @requires $replace_me
 *
 * */


evezownApp.factory('profileService', ['$http', '$q', 'PATHS', '$cookieStore' ,function ($http, $q, PATHS, $cookieStore){

    function getProfile ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'users/' + $userId)
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving user');
                deferred.reject(err);
            });
        return deferred.promise;
    }
    return {
        getProfile: getProfile
    };



}]);
