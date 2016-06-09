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

    $scope.pagesrc = $routeParams.pagesrc;

    $scope.manageStoreMenuItems = [
        {
            id: 0,
            name: 'Store Info',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_info/'+ $scope.pagesrc
        },
        {
            id: 1,
            name: 'Store Selection/Contract',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_selection/'+ $scope.pagesrc
        },
        {
            id: 2,
            name: 'Store Front',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_front/'+ $scope.pagesrc
        },
        {
            id: 3,
            name: 'Product Catalogue',
            link: 'store/' + $rootScope.currentStoreId + '/manage/product_catalogue/'+ $scope.pagesrc
        },
        {
            id: 5,
            name: 'Commerce Engine',
            link: 'store/' + $rootScope.currentStoreId + '/manage/commerce_engine/'+ $scope.pagesrc
        },
        {
            id: 6,
            name: 'Store Analytics',
            link: 'store/' + $rootScope.currentStoreId + '/manage/analytics/'+ $scope.pagesrc
        },
        {
            id: 7,
            name: 'Stock Management',
            link: 'store/' + $rootScope.currentStoreId + '/manage/stock_management/'+ $scope.pagesrc
        },
        {
            id: 8,
            name: 'Store Promotion',
            link: 'store/' + $rootScope.currentStoreId + '/manage/promotion/'+ $scope.pagesrc

        },
        {
            id: 9,
            name: 'CRM',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_crm/'+ $scope.pagesrc
        },
        {
            id: 11,
            name: 'Store Front Footer',
            link: 'store/' + $rootScope.currentStoreId + '/manage/store_front_footer/'+ $scope.pagesrc
        },
        {
            id: 10,
            name: 'Orders',
            link: 'store/' + $rootScope.currentStoreId + '/manage/orders/'+ $scope.pagesrc
        },
        {
            id: 11,
            name: 'Request for Quote',
            link: 'store/' + $rootScope.currentStoreId + '/manage/rfq/'+ $scope.pagesrc
        },
        {
            id: 12,
            name: 'Request for Info',
            link: 'store/' + $rootScope.currentStoreId + '/manage/rfi/'+ $scope.pagesrc
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