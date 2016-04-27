'use strict';

/**
 * @ngdoc function
 * @name evezownApp:Product search
 * @description
 * # Product search
 * Controller of the appApp
 */

evezownApp.controller('SearchProductController', function ($scope, $rootScope, $cookieStore, SECTIONS, $location, $routeParams, PATHS, $http) {

    
    $scope.Ranges = ['0 - 1000','1000 - 10,000','10,000 - 25,000','25,000 - 35,000','35,000 - 50,000','50,000 and above'];

    // selected Ranges
    $scope.selectedRange = [];

    $scope.imageUrl = PATHS.api_url + 'image/show/';

    $scope.searchkey="";

    $scope.userPagination = {};

    $scope.searchkey = $routeParams.searchKey;


    $scope.pageChanged = function () {
        console.log('Page changed to: ' + $scope.currentUserPage);
        $scope.GetProducts();
    };

    $scope.maxSize = 5;
    $scope.currentUserPage = 1;

    $scope.GetProducts = function () {
        $http.get(PATHS.api_url +  'products/search/' + $scope.searchkey +'?page='+$scope.currentUserPage).
        success(function(data) {
                console.log(data);
                $rootScope.Products = data.data;
                $scope.userPagination = data;
            });
    }

    if($scope.searchkey)
    {
        $scope.GetProducts();
        $scope.SearchValue = $scope.searchkey;
    }

    // toggle selection for a given range
    $scope.PriceRange = function(Range) 
    {

        var idx = $scope.selectedRange.indexOf(Range);

        // is already selected, then remove
        if (idx > -1) {
          $scope.selectedRange.splice(idx, 1);
          //alert($scope.selectedRange);
        }

        // is newly selected, then add
        else {
          $scope.selectedRange.push(Range);
          //alert($scope.selectedRange);
        }
    };

});

