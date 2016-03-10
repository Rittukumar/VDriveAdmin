'use strict';

/**
 * @ngdoc function
 * @name evezownApp:createBrowseController
 * @description
 * # createBrowseController
 * Controller of the appApp
 */
evezownApp.controller('createBrowseController', function ($scope, $rootScope, SECTIONS) {

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
});
