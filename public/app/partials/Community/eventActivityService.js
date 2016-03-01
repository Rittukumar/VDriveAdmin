/**
 * @ngdoc service
 * @name evezownapp.eventActivityService
 * @description
 * _Please update the description and dependencies._
 *
 * @requires $replace_me
 *
 * */


evezownApp
    .factory('eventActivityService', ['$http', '$q', 'PATHS', '$cookieStore' ,function ($http, $q, PATHS, $cookieStore){
        function getEventActivities ($eventId) {
            var deferred = $q.defer();
            $http.get(PATHS.api_url +  'users/events/' + $eventId + '/activities/all')
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
            getEventActivities: getEventActivities
        };
}]);
