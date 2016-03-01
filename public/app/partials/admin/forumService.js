/**
 * Created by vishu on 20/08/15.
 */
evezownApp.factory('ForumService', ['$http', '$q', 'PATHS', function ($http, $q, PATHS) {

    ForumService = {};
    ForumService.getForums = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url + 'users/forums/all')
            .success(function (data) {
                deferred.resolve(data.data);
            })
            .error(function (err) {
                console.log('Error retrieving forums');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ForumService.deleteForum = function ($userId, $forumId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url + 'users/forums/' + $forumId + '/delete', {user_id: $userId, forum_id: $forumId})
            .success(function (data) {
                deferred.resolve(data);
            })
            .error(function (err) {
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    };

    ForumService.getTrendingForums = function (sectionId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url + 'evezplace/' + sectionId + '/trending/forums')
            .success(function (data) {
                deferred.resolve(data.data);
            })
            .error(function (err) {
                console.log('Error retrieving forums');
                deferred.reject(err);
            });
        return deferred.promise;
    };

    ForumService.addForumShowEvezplace = function ($userId, $forumId, options) {
        console.log(options);
        var deferred = $q.defer();
        $http.post(PATHS.api_url + 'admins/' + $userId +'/forums/' + $forumId + '/add/trending', options)
            .success(function (data) {
                deferred.resolve(data);
            })
            .error(function (err) {
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    };

    return ForumService;
}]);