/**
 * Created by vishu on 06/11/15.
 */
evezownApp.controller('ProductRfiCtrl', function ($scope, productId, usSpinnerService,
                                                  StoreService, ngDialog) {

    console.log(productId);

    $scope.rfiData = {};

    // Crop Title image
    $scope.saveProductRfiDetails = function () {

        usSpinnerService.spin('spinner-1');

        StoreService.saveProductRfiDetails($scope.rfiData, productId)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close("", data);
            }).
            success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'RFI');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'RFI');

                });
    }
});