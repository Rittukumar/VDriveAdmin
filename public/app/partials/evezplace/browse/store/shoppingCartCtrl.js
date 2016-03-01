/**
 * Created by vishu on 06/11/15.
 */


evezownApp.controller('ShoppingCartCtrl', function ($scope, $cookieStore, StoreService,
                                                    usSpinnerService, ngTableParams, $rootScope,
                                                    PATHS, $location) {

    $scope.shoppingCartItems = StoreService.getShoppingCartItems();

    $scope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty();

    $scope.imageUrl = PATHS.api_url;

    $scope.removeFromCart = function ($product) {

        angular.forEach($scope.shoppingCartItems, function(value) {
            value.products.splice(value.products.indexOf($product), 1);

            if(value.products.length == 0) {
                $scope.shoppingCartItems.splice($scope.shoppingCartItems.indexOf(value), 1);
            }
        });

        $cookieStore.put('shoppingCartItems', $scope.shoppingCartItems);

        $scope.totalPrice = 0;
        $scope.totalShipping = 0;

        $scope.shoppingCartCount = 0;

        $scope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty;

        angular.forEach($scope.shoppingCartItems, function(value) {
            angular.forEach(value.products, function(product) {
                $scope.totalPrice =  +$scope.totalPrice +  (+product.price * +product.quantity);
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });

        toastr.success('Shopping Cart', 'Product removed from cart.');
    };

    function onQuantityChange() {
        $scope.totalPrice = 0;
        $scope.totalShipping = 0;

        $scope.shoppingCartCount = 0;

        $scope.isShoppingCartEmpty = !($scope.shoppingCartItems.length > 0);

        angular.forEach($scope.shoppingCartItems, function(value) {
            angular.forEach(value.products, function(product) {
                $scope.totalPrice =  +$scope.totalPrice +  (+product.price * +product.quantity);
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });

        if($cookieStore.get('shoppingCartItems')) {
            $cookieStore.remove('shoppingCartItems');
        }

        $cookieStore.put('shoppingCartItems', $scope.shoppingCartItems);

        $rootScope.$broadcast('shoppingCartItems', {message: $scope.shoppingCartItems});
    }

    $scope.$watch('shoppingCartItems', function () {
        onQuantityChange();
    }, true);

    console.log($scope.shoppingCartItems);

    // News table param for News table
    $scope.shoppingCartTableParams = new ngTableParams({
        page: 1,            // show first page
        count: 10           // count per page
    }, {
        total: $scope.shoppingCartItems.length, // length of data
        getData: function ($defer, params) {
            $defer.resolve($scope.shoppingCartItems.slice((params.page() - 1) * params.count(),
                params.page() * params.count()));
        }
    })

    $scope.placeOrder = function() {
        $location.path('/store/order/place');
    }
});

