/**
 * Created by Viswanathan on 6/29/2015.
 */
evezownApp
    .controller('BrowseClassifiedsCtrl', function ($scope, usSpinnerService,
                                                   ClassifiedsService, EvezplaceHomeService,
                                                   PATHS) {
        $scope.browseItems = [];


        $scope.ImageUrlPath = PATHS.api_url + 'image/show/';

        function loadClassifieds(subCatId) {
            ClassifiedsService.getClassifieds(subCatId).
            then(function (data) {
                console.log(data);
                $scope.browseItems = data;
            });
        }

        loadClassifieds(-1);

        $scope.$on('selectedSubCategory', function (event, args) {
            console.log(args.message.id);

            var subCatId = args.message.id;

            ClassifiedsService.getClassifieds(subCatId).
                then(function (data) {
                    console.log(data);
                    $scope.browseItems = data;
                });
        });

        $scope.classifiedSearchParams = {};

        function getSearchCategories () {

            EvezplaceHomeService.getCategories(5)
                .then(function (data) {
                    $scope.categories = data;
                });
        }

        $scope.getSearchSubCategories = function (categoryId) {

            EvezplaceHomeService.getSubcategories(categoryId)
                .then(function (data) {
                    $scope.classifiedSearchParams.subCategories = data;
                });
        }

        getSearchCategories();

        function clearSearchParams () {
            $scope.classifiedSearchParams = {};
        }

        $scope.clearSearchParams = function() {
            clearSearchParams();
        }

        $scope.closeSearch = function() {
            $scope.isAdvancedSearch = !$scope.isAdvancedSearch;
            clearSearchParams();
        }

        $scope.searchClassifieds = function() {

            ClassifiedsService.searchClassifieds($scope.classifiedSearchParams)
                .then(function (data) {
                    $scope.browseItems = data;
                    $scope.isAdvancedSearch = !$scope.isAdvancedSearch;
                    clearSearchParams();
                });
        }
    });

evezownApp.controller('classifiedProfileCtrl', function ($scope, usSpinnerService, ClassifiedsService, PATHS,$cookieStore,$routeParams) {

    $scope.browseItems = [];
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.currentUserId = $routeParams.id;
    $scope.ImageUrlPath = PATHS.api_url + 'image/show/';
    if($routeParams.id == undefined)
    {
        $scope.currentUserId = $scope.loggedInUserId;
    }
    $scope.getClassifiedsByUserId = function ()
    {
        ClassifiedsService.getClassifiedsByUserId($scope.currentUserId).
        then(function (data)
        {
            console.log(data);
            $scope.browseItems = data;
        });
    }

    $scope.getClassifiedsByUserId();
});
evezownApp.controller('classifiedRfiCtrl', function ($scope, usSpinnerService, classifiedId,
                                                     ClassifiedsService, ngDialog) {
    console.log(classifiedId);

    $scope.formData = {};

    // Crop Title image
    $scope.saveRfiDetails = function () {

        usSpinnerService.spin('spinner-1');

        ClassifiedsService.saveRfiDetails($scope.formData, classifiedId)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close("", data);
            });
    }
});

