/**
 * Created by vishu on 06/11/15.
 */
evezownApp.controller('ManageStoreMenuCtrl', function ($scope, $location, $routeParams,
                                                             EvezplaceHomeService,$http,PATHS,$rootScope) {

    if($routeParams.id)
    {
        $rootScope.currentStoreId = $routeParams.id;
    }
    else if($routeParams.storeId)
    {
        $rootScope.currentStoreId = $routeParams.storeId;
    }

    $scope.manageStoreMenuItems = [
        {
            id: 0,
            name: 'Store Info',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_info'
        },
        {
            id: 1,
            name: 'Store Selection/Contract',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_selection'
        },
        {
            id: 2,
            name: 'Store Front',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_front'
        },
        {
            id: 3,
            name: 'Product Catalogue',
            link: 'store/' + $rootScope.currentStoreId + '/manage/product_catalogue'
        },
        {
            id: 5,
            name: 'Commerce Engine',
            link: 'store/' + $rootScope.currentStoreId + '/manage/commerce_engine'
        },
        {
            id: 6,
            name: 'Store Analytics',
            link: 'store/' + $rootScope.currentStoreId + '/manage/analytics'
        },
        {
            id: 7,
            name: 'Stock Management',
            link: 'store/' + $rootScope.currentStoreId + '/manage/stock_management'
        },
        {
            id: 8,
            name: 'Store Promotion',
            link: 'store/' + $rootScope.currentStoreId + '/manage/promotion'

        },
        {
            id: 9,
            name: 'CRM',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_crm'
        },
        {
            id: 11,
            name: 'Store Front Footer',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_front_footer'
        },
        {
            id: 10,
            name: 'Orders',
            link: 'store/' + $rootScope.currentStoreId + '/manage/orders'
        },
        {
            id: 11,
            name: 'Request for Quote',
            link: 'store/' + $rootScope.currentStoreId + '/manage/rfq'
        },
        {
            id: 12,
            name: 'Request for Info',
            link: 'store/' + $rootScope.currentStoreId + '/manage/rfi'
        }
    ];

    $scope.navClass = function (page) {

        var currentRoute = $location.path().substring(1) || 'home';

        return page === currentRoute ? 'active' : '';
    };


    $scope.selectedManageStoreMenuItem = function (menuItem)
    {
        console.log('selected manage store menu: ' + menuItem);
        $rootScope.$broadcast('selectedSubCategory', { message: subcat });
    };
});