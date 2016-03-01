/**
 * @ngdoc service
 * @name evezownapp.friendsService
 * @description
 * _Please update the description and dependencies._
 *
 * @requires $replace_me
 *
 * */


evezownApp
    .factory('friendsService', ['$http', '$q', 'PATHS', '$cookieStore', function($http, $q, PATHS, $cookieStore){

        function getFriends ()
        {
            var deferred = $q.defer();
            $http.get(PATHS.api_url +  'users/' + $cookieStore.get('userId') + '/friends')
                .success(function(data){
                    deferred.resolve(data);
                })
                .error(function(err){
                    console.log('Error retrieving friends');
                    deferred.reject(err);
                });
            return deferred.promise;
        }
        return {
            getFriends: getFriends
        };
}]);

