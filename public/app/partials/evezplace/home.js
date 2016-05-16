evezownApp
    .controller('EvezplaceController', function ($scope, $cookieStore) {
        $scope.title = "EvezPlace";

        $scope.Role = $cookieStore.get('userRole');
        
        $scope.accessCtrl =  function()
        {
            toastr.info("You should have Business subscription to access this feature");
        }
    });

evezownApp.controller('ProductMenuController', function ($rootScope, $scope, $location,
                                                         EvezplaceHomeService, $routeParams, SECTIONS) {

    $scope.productNavLinks = [{
        Index: 0,
        Title: 'evezplace',
        LinkText: 'Stores'
    }, {
        Index: 1,
        Title: 'services',
        LinkText: 'Business'
    }, {
        Index: 2,
        Title: 'productServices',
        LinkText: 'Business (Product + Service)'
    }, {
        Index: 3,
        Title: 'Ads & Campaigns',
        LinkText: 'Ads & Campaigns'
    }];

    $scope.selectedIndex = 0;

    $scope.selectMenu = function(index) {

        $scope.selectedIndex = index;

        $rootScope.$broadcast('selectedEvezplaceSectionIndex', { index : $scope.selectedIndex });

        getCategories();
    };

    $scope.currentSection = 0;

    $scope.navClass = function (index) {

        if (index == 0) {
            $rootScope.currentSection = 3;
            $rootScope.storeType = "Store"
        }
        else if (index == 1) {
            $rootScope.currentSection = 4;
            $rootScope.storeType = "Service"
        }
        else if (index == 2) {
            $rootScope.currentSection = 6;
        }
        else if (index == 3) {
            $rootScope.currentSection = 5;
        }

        return index == $scope.selectedIndex ? 'active' : '';
    };

    getCategories();

    function getCategories() {

        if ($scope.selectedIndex == 0) {
            $scope.currentSection = 3;
        }
        else if ($scope.selectedIndex == 1) {
            $scope.currentSection = 4;
        }
        else if ($scope.selectedIndex == 2) {
            $scope.currentSection = 6;
        }
        else if ($scope.selectedIndex == 3) {
            $scope.currentSection = 5;
        }

        EvezplaceHomeService.getCategories($scope.currentSection)
            .then(function (data) {
                $scope.categories = data;
            });
    }

});



evezownApp.controller('BrowseStoreController', function ($scope) {

});

evezownApp.controller('BrowseStoreMenuController', function ($scope, $location,
                                                             EvezplaceHomeService,$http,PATHS,$rootScope,$routeParams) {

    
    if($routeParams.searchKey != undefined)
    {
        $scope.SearchKey = $routeParams.searchKey;
    }
    else
    {
        $scope.SearchKey = "";
    }

    $scope.getCategories = function () {
        var currentRoute = $location.path().substring(1);

        if (currentRoute == 'store/browse') {
            $scope.currentSection = 3;
        }
        else if (currentRoute == 'store/services') {
            $scope.currentSection = 4;
        }
        else if (currentRoute == 'classifieds/browse') {
            $scope.currentSection = 5;
        }
        else if (currentRoute == 'productServices/browse') {
            $scope.currentSection = 6;
        }
        else if (currentRoute == 'search/products/' + $routeParams.searchKey) {
            $scope.currentSection = 3;
        }

        EvezplaceHomeService.getCategories($scope.currentSection)
            .then(function (data) {
                $scope.categories = data;
                $scope.selectedCategory = $scope.categories[0].id;

                $scope.selectSubCatPosition();
            });
    }

    $scope.getCategories();

    $scope.selectSubCatPosition = function (subcat)
    {
        console.log('selected sub cat: ' + subcat);
        $rootScope.$broadcast('selectedSubCategory', { message: subcat });
    };
});

evezownApp.controller('StoreInfoController', function ($scope, $location, $cookieStore) {

    $scope.storeInfoNavLinks = [{
        Title: 'whatdoiget',
        LinkText: 'What Do I Get'
    }, {
        Title: 'typeofstores',
        LinkText: 'Types of Stores'
    }, {
        Title: 'faq',
        LinkText: 'FAQ'
    }];

    $scope.navClass = function (page) {

        var currentRoute = $location.path().substring(1) || 'home';

        return page === currentRoute ? 'active' : '';
    };

    $scope.Create_Store = function() {

        $scope.loggedInUserId = $cookieStore.get('userId');
        
        if($scope.loggedInUserId)
        {
            $location.path("/store/create/step1");
        }
        else
        {
            $cookieStore.put('FromSource', "FromCreateStore");
            $location.path("/login");
        }
    }
});

//evezplace home page images
evezownApp.controller('EvezplaceImages', function ($scope, ngDialog, $filter, ngTableParams, $cookieStore,
                                         $routeParams, StoreService, PATHS, $controller) {

    $scope.imageUrl = PATHS.api_url + 'image/show/';

    //get products of store 56
    function getProducts(storeId) {
        StoreService.getProductLines(storeId).
            then(function (data) {
                var productlines = data;

                $scope.productLines = productlines;
            });

    }
    getProducts("56");

    //get products of store 46
    function getStoreProducts(storeId) {
        StoreService.getProductLines(storeId).
            then(function (data) {
                var productlines2 = data;

                $scope.productLines2 = productlines2;
            });

    }
    getStoreProducts("46");
});
