/**
 * Created by vishu on 06/11/15.
 */

evezownApp.controller('storeRfqCtrl', function ($scope, storeId, usSpinnerService,
                                                StoreService, ngDialog, ngTableParams, $filter) {

    console.log(storeId);

    $scope.rfqData = {};

    $scope.selectedProduct = {};

    // Get product lines.
    function getProductLines(storeId) {
        StoreService.getProductLines(storeId).
            then(function (data) {
                var productLines = data;
                console.log(productLines);

                $scope.productLines = productLines;

                $scope.products = productLines[0].products
            });
    }

    getProductLines(storeId);

    $scope.selectProductLine = function (productLine) {
        console.log(productLine);
        $scope.products = productLine.products;
    }

    $scope.addProduct = function () {
        console.log($scope.selectedProduct.product);
        var enquiryProduct = {
            id: $scope.selectedProduct.product.id,
            title: $scope.selectedProduct.product.title,
            quantity: $scope.selectedProduct.quantity,
            delivery_date: $scope.selectedProduct.deliveryDate,
            delivery_city: $scope.selectedProduct.deliveryCity,
            purchase_date: $scope.selectedProduct.purchaseDate
        }

        $scope.rfqData.enquiryProducts.push(enquiryProduct);

        $scope.selectedProduct = {};
    }

    $scope.removeProduct = function (product) {
        console.log(product);
        var index = $scope.rfqData.enquiryProducts.indexOf(product);
        $scope.rfqData.enquiryProducts.splice(index, 1);
    }

    $scope.today = function () {
        $scope.selectedDeliveryDate = $filter('date')(new Date(), "dd-MMMM-yyyy");
        $scope.selectedPurchaseDate = $filter('date')(new Date(), "dd-MMMM-yyyy");
    };

    $scope.today();

    // Disable weekend selection
    $scope.disabled = function (date, mode) {
        return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    };

    $scope.toggleMin = function () {
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open = function ($event, which) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.datepickers[which] = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 2);
    $scope.events =
        [
            {
                date: tomorrow,
                status: 'full'
            },
            {
                date: afterTomorrow,
                status: 'partially'
            }
        ];

    $scope.getDayClass = function (date, mode) {
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    };

    $scope.rfqData.enquiryProducts = [];

    $scope.tableParams = new ngTableParams({
        page: 1,            // show first page
        count: 12           // count per page
    }, {
        total: $scope.rfqData.enquiryProducts.length, // length of data
        getData: function ($defer, params) {
            var pageData = $scope.rfqData.enquiryProducts.slice((params.page() - 1) * params.count(), params.page() * params.count()),
                sum = 0;

            // calculate summary
            angular.forEach(pageData, function (item) {
                sum += item.age;
            });
            $scope.sum = sum;
            $defer.resolve(pageData);
        }
    })

    $scope.saveStoreRfqDetails = function () {

        usSpinnerService.spin('spinner-1');

        StoreService.saveStoreRfqDetails($scope.rfqData, storeId)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close("", data);
            });
    }
});