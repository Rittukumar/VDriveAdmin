evezownApp
    .controller('profileCountCtrl', function ($scope, $http, PATHS, $routeParams, $cookieStore, $rootScope) {

        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;
        
        if ($routeParams.id != undefined) {
            $scope.currentUserId = $routeParams.id;
        }
        else {
            $scope.currentUserId = $scope.loggedInUserId;
        }


        $scope.getUserProfileCount =  function () {

            $http.get(PATHS.api_url + 'users/' + $scope.currentUserId +'/getUserProfileCount').
            success(function (data) {

                $rootScope.friendsList = data.friendsList;
                $rootScope.circlesList = data.circlesList;
                $rootScope.eventssList = data.eventssList;
                $rootScope.blogsList   = data.blogsList;
                $rootScope.albumsList  = data.albumsList;
                
            });

        };

        $scope.getUserProfileCount();


       
    });