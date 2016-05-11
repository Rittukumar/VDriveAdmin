/**
 * Order Controller
 */

evezownApp
    .controller('orderCtrl', function ($scope, $routeParams, $location, AuthService, profileService, $http, PATHS,
                                       $cookieStore, $rootScope, usSpinnerService) {

        
        $scope.htitle = "Buy History";

        $scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentBuyHistoryPage);
            $scope.GetBuyHistoryPagination ();
        };

        
        $scope.currentBuyHistoryPage = 1;

        $scope.GetBuyHistoryPagination = function () {
            $http.get(PATHS.api_url + 'orders/'+$cookieStore.get('userId')+'/buyHistory?page='+$scope.currentBuyHistoryPage).
            success(function(data) {
                    console.log(data);
                    $scope.getBuyHistory = data.data;
                    usSpinnerService.stop('spinner-1');
                    $scope.buyHistoryPagination = data.meta.pagination;
                }).then(function () {

                });
        }
        $scope.GetBuyHistoryPagination ();
        
    });

