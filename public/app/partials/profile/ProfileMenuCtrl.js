/**
 * Profile leftside menus
 */

evezownApp
    .controller('ProfileMenuCtrl', function ($scope, $routeParams, $location,AuthService, profileService,$http,PATHS,FileUploader,$cookieStore,ImageService,$rootScope) {

        $scope.profileMenuItems=[];
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;

        if($scope.loggedInUserId == $routeParams.id)
        {
            $scope.profileMenuItems.push({name: 'Manage Evezsite',
            link : 'profile/' + $scope.loggedInUserId + '/personalinfo'});
        }

        $scope.profileMenuItems.push({
            name: 'Build Community',
            link : 'community'
        },{
            name: 'Streamit',
            link : 'streamit'
        },{
            name: 'Recent Activity',
            link : 'profile/' + $routeParams.id
        },{
            name: 'Stores',
            link : 'mystores/' + $routeParams.id
        },{
            name: 'Classifieds',
            link : 'mylisting/' + $routeParams.id
        },{
            name: 'Blogs',
            link : 'myblogs/' + $routeParams.id
        },{
            name: 'Events',
            link : 'myevents/' + $routeParams.id
        },{
            name: 'Gallery',
            link : 'myalbums/' + $routeParams.id
        },{
            name: 'Groups',
            link : 'mygroups/' + $routeParams.id

        },{
            name: 'Discussion',
            link : 'mydiscussion/' + $routeParams.id

        });

        $scope.navClass = function (page) {

            var currentRoute = $location.path().substring(1) || 'home';

            return page === currentRoute ? 'active' : '';
        };
    });

