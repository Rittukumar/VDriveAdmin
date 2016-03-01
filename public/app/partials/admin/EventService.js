evezownApp.factory('EventService', ['$http', '$q', 'PATHS', function ($http, $q, PATHS) {

    EventService = {};
    EventService.getEvents = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url + 'users/events/all')
            .success(function (data) {
                deferred.resolve(data.data);
            })
            .error(function (err) {
                console.log('Error retrieving events');
                deferred.reject(err);
            });
        return deferred.promise;
    };

    EventService.deleteEvent = function ($userId, $eventId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url + 'event/' + $eventId + '/delete', {user_id: $userId, event_id: $eventId})
            .success(function (data) {
                deferred.resolve(data);
            })
            .error(function (err) {
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    };

    EventService.addEventShowEvezplace = function ($userId, $eventId, options) {
        console.log(options);
        var deferred = $q.defer();
        $http.post(PATHS.api_url + 'admins/' + $userId +'/events/' + $eventId + '/add/trending', options)
            .success(function (data) {
                deferred.resolve(data);
            })
            .error(function (err) {
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    };

    EventService.getTrendingEvents = function (sectionId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url + 'evezplace/' + sectionId + '/trending/events')
            .success(function (data) {
                deferred.resolve(data.data);
            })
            .error(function (err) {
                console.log('Error retrieving events');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    return EventService;
}]);