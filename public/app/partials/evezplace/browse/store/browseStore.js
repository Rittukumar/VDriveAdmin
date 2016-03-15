/**
 * Created by Viswanathan on 6/23/2015.
 */
evezownApp
    .controller('BrowseStoreCtrl', function ($scope, $rootScope, $http, PATHS, $cookieStore,
                                             $routeParams, EvezplaceHomeService, StoreService) {
        $scope.browseItems = [];
        $scope.browseMyItems = [];
        $scope.storePagination = {};
        $scope.service_url = PATHS.api_url;
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;
        $scope.currentSubCategoryId = -1;

        $scope.isAdvancedSearch = false;

        $scope.searchStorePopover = {
            templateUrl: 'views/templates/store-search-popover.tpl.html',
            content: 'Search based on:'
        };

        $scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentStorePage);
            $scope.GetProductsByPagination($scope.currentSubCategoryId);
        };

        $scope.maxSize = 5;
        $scope.currentStorePage = 1;

        if ($routeParams.id != undefined) {
            $scope.currentUserId = $routeParams.id;
        }
        else {
            $scope.currentUserId = $scope.loggedInUserId;
        }

        $rootScope.$on('selectedSubCategory', function (event, args) {
            $scope.currentSubCategoryId = args.message.id;
            $scope.GetProductsBySubCatId(args.message.id);
        });

        $scope.GetProductsBySubCatId = function (subCatId) {
            $http.get(PATHS.api_url + 'stores/subcategory/' + subCatId + '/get?page=' + $scope.currentStorePage).
                success(function (data) {
                    console.log(data);
                    $scope.browseItems = data.data;
                    $scope.storePagination = data.meta.pagination;
                }).then(function () {

                });
        }

        $scope.GetProductsByPagination = function (subCatId) {
            $http.get(PATHS.api_url + 'stores/subcategory/' + subCatId + '/get?page=' + $scope.currentStorePage).
                success(function (data) {
                    console.log(data);
                    $scope.browseItems = data.data;
                    $scope.storePagination = data.meta.pagination;
                }).then(function () {

                });
        }

        // Set the subcategory id as -1 on initial load (no selection)
        $scope.GetProductsBySubCatId($scope.currentSubCategoryId);

        $scope.GetProductsByOwnerId = function () {
            $http.get(PATHS.api_url + 'stores/owner/' + $scope.currentUserId + '/get').
                success(function (data) {
                    $scope.browseMyItems = data;
                }).then(function () {

                });
        }

        $scope.storeSearchParams = {};

        $scope.storeTypes = [{
            Index: 0,
            Title: 'Stores'
        }, {
            Index: 1,
            Title: 'Business'
        }, {
            Index: 2,
            Title: 'Stores + Business'
        }];

        $scope.getSearchCategories = function ($storeType) {

            if ($storeType == 0) {
                $scope.currentSection = 3;
            }
            else if ($storeType == 1) {
                $scope.currentSection = 4;
            }
            else if ($storeType == 3) {
                $scope.currentSection = 5;
            }
            else if ($storeType == 2) {
                $scope.currentSection = 6;
            }

            EvezplaceHomeService.getCategories($scope.currentSection)
                .then(function (data) {
                    $scope.categories = data;
                });
        }

        $scope.getSearchSubCategories = function (categoryId) {

            EvezplaceHomeService.getSubcategories(categoryId)
                .then(function (data) {
                    $scope.storeSearchParams.subCategories = data;
                });
        }

        $scope.getSearchCategories();

        function clearSearchParams () {
            $scope.storeSearchParams = {};
        }

        $scope.clearSearchParams = function() {
            clearSearchParams();
        }

        $scope.closeSearch = function() {
            $scope.isAdvancedSearch = !$scope.isAdvancedSearch;
            clearSearchParams();
        }

        $scope.searchStores = function() {

            StoreService.searchStores($scope.storeSearchParams)
                .then(function (data) {
                    $scope.browseItems = data.data;
                    $scope.browseMetaData = data.meta;
                    $scope.isAdvancedSearch = !$scope.isAdvancedSearch;
                    clearSearchParams();
                });
        }
    });




