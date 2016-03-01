/**
 * Profile leftside menus
 */

evezownApp
    .controller('AdminMenuCtrl', function ($scope, $routeParams, $location,AuthService, profileService,$http,PATHS,FileUploader,$cookieStore,ImageService,$rootScope) {

        $scope.adminMenuItems=[];
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;

        

        $scope.adminMenuItems.push({
            name: 'Invites',
            link : 'admin' 
        },{
            name: 'Users',
            link : 'admin/users/'+$scope.loggedInUserId
        },{
            name: 'Blogs',
            link : 'admin/blog' 
        },{
            name: 'Groups',
            link : 'admin/groups' 
        },{
            name: 'Events',
            link : 'admin/events' 
        },{
            name: 'Discussion',
            link : 'admin/forums' 
        },{
            name: 'Gallery',
            link : 'admin/album' 
        },{
            name: 'Stores',
            link : 'admin/store' 

        },{
            name: 'Opportunities',
            link : 'admin/opportunities' 

        },{
            name: 'Woice',
            link : 'admin/woice' 

        },{
            name: 'Woice-flag',
            link : 'admin/woiceflag' 

        },{
            name: 'Brand',
            link : 'admin/addbrand' 

        },{
            name: 'News, Articles, Interviews & Videos',
            link : 'admin/articles'

        },{
            name: 'News Letter',
            link : 'admin/newsletter' 

        },{
            name: 'Evezplace Promotions',
            link : 'admin/evezplace/promotion'

        },{
            name: 'Evezplace Recommendations',
            link : 'admin/evezplace/recommendations'

        },{
            name: 'Evezplace Trending Items',
            link : 'admin/evezplace/trending'

        });

        $scope.navClass = function (page) {

            var currentRoute = $location.path().substring(1) || 'home';

            return page === currentRoute ? 'active' : '';
        };
    });

