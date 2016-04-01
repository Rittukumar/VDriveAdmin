
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
        
        $scope.GetContracts = function()
        {
            $http.get(PATHS.api_url + 'stores/admin/contract').
            success(function(data)
            {
                $scope.storeContract = data;
                usSpinnerService.stop('spinner-1');
            });
        }
        $scope.GetContracts();
        

        $scope.updateContractStatus = function(status, contract) {

            $scope.storeContractStatus = status;

            $scope.storeContractEmail = contract.store_front_info.store_contact_email;

            $scope.storeContractName = contract.title;

            $scope.ContractStoreID = contract.business_info.store_id;

            $http.post(PATHS.api_url + 'stores/admin/contract/update'
                , {
                    data: {
                        StoreId: $scope.ContractStoreID,
                        storeEmail: $scope.storeContractEmail,
                        storeName: $scope.storeContractName,
                        storeStatus: $scope.storeContractStatus
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                toastr.success(data.message, 'Store');
                $scope.GetContracts();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
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