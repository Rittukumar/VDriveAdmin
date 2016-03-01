/**
 * Created by vishu on 06/11/15.
 */
evezownApp.controller('AdminManageStoreMenuCtrl', function ($scope, $location, $routeParams,
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
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_store_info'
        },
        {
            id: 1,
            name: 'Store Selection/Contract',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_store_selection'
        },
        {
            id: 2,
            name: 'Store Front',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_store_front'
        },
        {
            id: 3,
            name: 'Product Catalogue',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_product_catalogue'
        },
        {
            id: 5,
            name: 'Commerce Engine',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_commerce_engine'
        },
        {
            id: 6,
            name: 'Store Analytics',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_analytics'
        },
        {
            id: 7,
            name: 'Stock Management',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_stock_management'
        },
        {
            id: 8,
            name: 'Store Promotion',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_store_promotion'

        },
        {
            id: 9,
            name: 'CRM',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_store_crm'
        },
        {
            id: 11,
            name: 'Store Front Footer',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_store_front_footer'
        },
        {
            id: 10,
            name: 'Orders',
            link: 'admin/store/' + $rootScope.currentStoreId + '/manage/admin_orders'
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