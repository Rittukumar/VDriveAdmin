/**
 * Profile leftside menus
 */

evezownApp
    .controller('ProfileMenuCtrl', function ($scope, $routeParams, $location,AuthService, profileService,$http,PATHS,FileUploader,$cookieStore,ImageService,$rootScope) {

        $scope.profileMenuItems=[];
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;
        $scope.Role = $cookieStore.get('userRole');

        $scope.profileMenuItems.push({
            name: 'Stores',
            link : 'mystores/' + $routeParams.id
        },{
            name: 'Ads & Campaigns',
            link : 'mylisting/' + $routeParams.id
        });

        if($scope.loggedInUserId == $routeParams.id)
        {
            $scope.profileMenuItems.push({
            name: 'Stream It',
            link : 'streamit'
            },{
            name: 'Build Community',
            link : 'community'
            });
        }

        $scope.profileMenuItems.push({
            name: 'Promotional Tools',
            link : 'myblogs/' + $routeParams.id
        },{
            name: 'Recent Activity',
            link : 'profile/' + $routeParams.id
        });

        if($scope.loggedInUserId == $routeParams.id)
        {
            $scope.profileMenuItems.push({
            name: 'Buy History',
            link : 'buyHistory/' + $routeParams.id
            });
        }

        $scope.navClass = function (page) {

            var currentRoute = $location.path().substring(1) || 'home';

            return page === currentRoute ? 'active' : '';
        };
    });

