/**
 * Created by vishu on 20/08/15.
 */
  evezownApp.factory('GroupService', ['$http', '$q', 'PATHS' ,function ($http, $q, PATHS){

    GroupService = {};
    GroupService.getGroups = function () {
    var deferred = $q.defer();
    $http.get(PATHS.api_url  + 'users/groups/all')
        .success(function(data){
            deferred.resolve(data.data);
        })
        .error(function(err){
            console.log('Error retrieving groups');
            deferred.reject(err);
        });
        return deferred.promise;
    }

    GroupService.deleteGroup = function ($userId, $groupId) {
    var deferred = $q.defer();
    $http.get(PATHS.api_url + 'users/groups/'+$groupId+'/delete', { user_id : $userId, group_id : $groupId})
    .success(function(data){
            deferred.resolve(data);
        })
        .error(function(err){
            console.log('Error on saving');
            deferred.reject(err);
        });
        return deferred.promise;
    }
    return GroupService;
}]);