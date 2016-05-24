/**
 * Profile leftside menus
 */

evezownApp
    .controller('PromotionalMenuCtrl', function ($scope, $routeParams, $location,AuthService, profileService,$http,PATHS,FileUploader,$cookieStore,ImageService,$rootScope) {

        $scope.PromotionalMenuItems=[];
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;
        $scope.Role = $cookieStore.get('userRole');

        $scope.PromotionalMenuItems.push(
        {
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

