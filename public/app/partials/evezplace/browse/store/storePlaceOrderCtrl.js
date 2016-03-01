/**
 * Created by vishu on 06/11/15.
 */

evezownApp.controller('StorePlaceOrderCtrl', function ($scope, StoreService, usSpinnerService,
                                                       ngFabForm, $cookieStore, $rootScope, PATHS) {

    $scope.imageUrl = PATHS.api_url;

    $scope.defaultFormOptions = ngFabForm.config;
    $scope.customFormOptions = angular.copy(ngFabForm.config);

    $scope.shoppingCartItems = StoreService.getShoppingCartItems();

    $scope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty();

    $scope.isOrderSuccess = false;

    $scope.totalPrice = 0;
    $scope.totalShipping = 0;

    $scope.shoppingCartCount = 0;

    function calculateTotal() {

        angular.forEach($scope.shoppingCartItems, function (value) {
            angular.forEach(value.products, function (product) {
                $scope.totalPrice = +$scope.totalPrice + (+product.price * +product.quantity);
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });
    }

    calculateTotal();

    $scope.orderData = {};

    $scope.orderData.orders = [];

    $scope.orderData.buyer = {};

    angular.forEach($scope.shoppingCartItems, function (value) {

        var order = {
            storeId: value.storeId,
            storeTitle: value.storeTitle

        };

        order.orderItems = [];

        order.totalAmount = 0;

        order.shippingCharges = 0;

        angular.forEach(value.products, function (product) {
            var orderProduct = {
                product_id: product.id,
                title: product.title,
                quantity: product.quantity,
                price: product.price,
                image: product.image,
                isCollapsed: true
            };

            order.totalAmount = +order.totalAmount + (+orderProduct.price * +orderProduct.quantity);

            order.orderItems.push(orderProduct);
        });

        $scope.orderData.orders.push(order);
    });

    // Copy billing to shipping address.
    $scope.copyBillingAddress = function(orderItem) {
        if(orderItem.isShippingEqualBilling)
            orderItem.shipping_address = orderItem.billing_address;
        else
            orderItem.shipping_address = {};
    };

    $scope.submitOrder = function () {
        console.log($scope.orderData);
        usSpinnerService.spin('spinner-1');
        StoreService.placeOrder($scope.orderData).
            then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Submit Order');
                $cookieStore.remove('shoppingCartItems');
                $scope.isOrderSuccess = true;

                $scope.transactions = [];
                angular.forEach(data.transactions, function(value) {
                    $scope.transactions.push(value);
                });

                $rootScope.$broadcast('shoppingCartItems', {message: null});
            },
            function (data) {
                toastr.error(data.error.message.message, 'Submit Order')
            });
    }
});

