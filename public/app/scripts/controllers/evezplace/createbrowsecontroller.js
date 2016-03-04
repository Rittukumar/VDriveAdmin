'use strict';

/**
 * @ngdoc function
 * @name evezownApp:createBrowseController
 * @description
 * # createBrowseController
 * Controller of the appApp
 */
evezownApp.controller('createBrowseController', function ($scope, $rootScope, SECTIONS) {

    $scope.storeType = "Product";

    $rootScope.$on('selectedEvezplaceSectionIndex', function (event, args) {
        var index = args.index;

        console.log('create browse store section - selected section index ' + index);

        if(index == SECTIONS.products) {
            $scope.storeType = "Product"
        }

        if(index == SECTIONS.services) {
            $scope.storeType = "Service"
        }

        if(index == SECTIONS.productPlusServices) {
            $scope.storeType = "Product + Service"
        }

        if(index == SECTIONS.classifieds) {
            $scope.storeType = "Classified"
        }

        // Check if the section is classifieds.
        $scope.isClassified = index == SECTIONS.classifieds;
        $scope.isProductPlusService = index == SECTIONS.productPlusServices;
    });
});
