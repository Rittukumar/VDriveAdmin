
'use strict';

evezownApp
    .controller('storelist',
    function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService,Session)
    {

        $scope.stores = [];
        $scope.storeStatusEnum = [];
        $scope.title = "Stores";
        usSpinnerService.spin('spinner-1');

        $scope.GetAllStores = function()
        {
            $http.get(PATHS.api_url + 'stores').
            success(function(data)
            {
                $scope.stores = data;
                usSpinnerService.stop('spinner-1');
            });
        }

        $scope.GetAllStoreStatusEnums = function()
        {
            $http.get(PATHS.api_url + 'users/store/getstorestatus/enums').
            success(function(data)
            {
                $scope.storeStatusEnum = data;
                usSpinnerService.stop('spinner-1');
                $scope.GetAllStores();
            });
        }

        $scope.UpdateStoreStatus = function(store)
        {
            $http.post(PATHS.api_url + 'users/store/updatestorestatus/update'
                , {
                    data: {
                        StoreId: store.id,
                        storeStatus: store.store_status.status_id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                toastr.success(data.message, 'Store');

            }).error(function (data) {
                toastr.error(data.error.message, 'Store');
            }).then(function () {
                $scope.GetAllStores();
            });
        }
        $scope.GetAllStoreStatusEnums();
    });