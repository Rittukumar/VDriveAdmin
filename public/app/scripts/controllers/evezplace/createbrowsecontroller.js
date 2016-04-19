'use strict';

/**
 * @ngdoc function
 * @name evezownApp:createBrowseController
 * @description
 * # createBrowseController
 * Controller of the appApp
 */
evezownApp.controller('createBrowseController', function ($scope, $rootScope, $cookieStore, SECTIONS, $location) {

    $scope.storeType = "Stores";

    $rootScope.$on('selectedEvezplaceSectionIndex', function (event, args) {
        var index = args.index;

        console.log('create browse store section - selected section index ' + index);

        if(index == SECTIONS.products) {
            $scope.storeType = "Stores"
        }

        if(index == SECTIONS.services) {
            $scope.storeType = "Business"
        }

        if(index == SECTIONS.productPlusServices) {
            $scope.storeType = "Store/Business"
        }

        if(index == SECTIONS.classifieds) {
            $scope.storeType = "Ads & Campaigns"
        }

        // Check if the section is classifieds.
        $scope.isClassified = index == SECTIONS.classifieds;
        $scope.isProductPlusService = index == SECTIONS.productPlusServices;
    });

    $scope.SearchProducts = function (SearchValue)
    {
        if(SearchValue == undefined)
        {
            toastr.error('Please enter any product name');
        }
        else
        {
            $location.path('/search/products/' + SearchValue);
        }
    }
});


evezownApp.controller('SearchProductController', function ($scope) {

    
    $scope.Ranges = ['All','100 - 1000','1000 - 5000','5000 - 25,000','25,000 - 75,000','75000 - 1,00,000'];

    // selected Ranges
    $scope.selectedRange = [];

    // toggle selection for a given range
    $scope.PriceRange = function(Range) 
    {

        var idx = $scope.selectedRange.indexOf(Range);

        // is already selected, then remove
        if (idx > -1) {
          $scope.selectedRange.splice(idx, 1);
          alert($scope.selectedRange);
        }

        // is newly selected, then add
        else {
          $scope.selectedRange.push(Range);
          alert($scope.selectedRange);
        }
    };

});

