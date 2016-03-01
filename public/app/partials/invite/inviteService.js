evezownApp
    .factory('InviteService',
    function($http, PATHS, $q) {

        InviteService = {};

        InviteService.save = function (inviteData) {

            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'invite/request', inviteData)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error on saving');
                    deferred.reject(err);
                });
            return deferred.promise;
        }

        return InviteService;
    });


