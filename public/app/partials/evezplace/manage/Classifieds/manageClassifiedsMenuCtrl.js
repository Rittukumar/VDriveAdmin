/**
 * Created by vishu on 06/11/15.
 */
evezownApp.controller('ManageClassifiedMenuCtrl', function ($scope, $location, $routeParams,
                                                       EvezplaceHomeService,$http,PATHS,$rootScope) {

    if($routeParams.id)
    {
        $rootScope.currentClassifiedId = $routeParams.id;
    }
    else if($routeParams.storeId)
    {
        $rootScope.currentClassifiedId = $routeParams.storeId;
    }

    $scope.manageStoreMenuItems = [
        {
            id: 0,
            name: 'Classified Type',
            link: 'classified/' + $rootScope.currentClassifiedId + '/manage/classified_type'
        },
        {
            id: 1,
            name: 'Classified Info',
            link: 'classified/' + $rootScope.currentClassifiedId + '/manage/classified_info'
        },
        {
            id: 2,
            name: 'Classified Promotion',
            link: 'classified/' + $rootScope.currentClassifiedId + '/manage/classified_promotion'
        },
        {
            id: 3,
            name: 'Classified RFI',
            link: 'classified/' + $rootScope.currentClassifiedId + '/manage/classified/rfi'
        }
    ];

    $scope.navClass = function (page) {

        var currentRoute = $location.path().substring(1) || 'home';

        return page === currentRoute ? 'active' : '';
    };


    //$scope.selectedManageStoreMenuItem = function (menuItem)
    //{
    //    console.log('selected manage classified menu: ' + menuItem);
    //    $rootScope.$broadcast('selectedSubCategory', { message: subcat });
    //};
});