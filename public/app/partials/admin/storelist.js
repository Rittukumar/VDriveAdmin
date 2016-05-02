
'use strict';

evezownApp
    .controller('storelist',
    function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService, Session, ngDialog, $cookieStore)
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

        /*$scope.StoreStatusRequestUpdate = function(storeId, storeEmail, storeName)
        {
            $http.post(PATHS.api_url + 'users/store/setstorestatus/Accept'
                , {
                    data: {
                        StoreId: storeId,
                        storeEmail: storeEmail,
                        storeName: storeName
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                toastr.success(data.message, 'Store');
                $scope.GetAllStores();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
            });
        }*/

        /*$scope.StoreStatusContent = function(storeId, storeEmail, storeName, content)
        {
            $http.post(PATHS.api_url + 'users/store/setstorestatus/Reject'
                , {
                    data: {
                        StoreId: storeId,
                        storeEmail: storeEmail,
                        storeName: storeName,
                        EmailContent: content
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                toastr.success(data.message, 'Store');
                $scope.GetAllStores();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
            });
        }*/

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


        //Admin update store status
        $scope.UpdateStoreStatus = function(store)
        {
            //Activate Store
            if(store.store_status.status_id == 2)
            {
                $scope.store = store;
                $scope.Premium = 25000;
                $scope.freetrail = 2;
                $scope.store_id = $scope.store.store_status.store_id;
                $scope.store_email = $scope.store.store_front_info.store_contact_email;
                $scope.store_name = $scope.store.title;
                $scope.store_sub_type =  store.store_subscription_id;
                
                //Free trail
                if($scope.store_sub_type == 1)
                {
                    ngDialog.openConfirm({            
                    template: '<div><h3 class="text-center">Store Title : {{store.title}}</h3>' +
                    '<h4 class="text-center">Subscription Type : Free Trail</h4>'+
                    '<h5>Free Trail: <input type="text" class="form-control" ng-model="freetrail"/></h5>' +
                    '<h5>Premium: <input type="text" class="form-control" ng-model="Premium"/></h5>' +
                    '<input type="button" value="Make offer" class="center" ng-click="MakeOfferFree(store_id,store_email,store_name,freetrail,Premium);"/>' +
                    '<input type="button" value="close" class="center" ng-click="closeThisDialog()"/></div>' ,
                    plain: true,
                    scope:$scope           
                    });
                }

                //Premium
                else if($scope.store_sub_type == 2)
                {
                    ngDialog.openConfirm({            
                    template: '<div><h3 class="text-center">Store Title : {{store.title}}</h3>' +
                    '<h4 class="text-center">Subscription Type : Premium</h4>'+
                    '<h5>Premium: <input type="text" class="form-control" ng-model="Premium"/></h5>' +
                    '<input type="button" value="Make offer" class="center" ng-click="MakeOfferPre(store_id,store_email,store_name,Premium);"/>' +
                    '<input type="button" value="close" class="center" ng-click="closeThisDialog()"/></div>' ,
                    plain: true,
                    scope:$scope           
                    });
                }

                //customized
                else if($scope.store_sub_type == 3)
                {
                    ngDialog.openConfirm({            
                    template: '<div><h3 class="text-center">Store Title : {{store.title}}</h3>' +
                    '<h4 class="text-center">Subscription Type : Customized</h4>'+
                    '<h5>Customized: <input type="text" class="form-control" ng-model="Customized"/></h5>' +
                    '<input type="button" value="Make offer" class="center" ng-click="MakeOfferCustom(store_id,store_email,store_name,Customized);"/>' +
                    '<input type="button" value="close" class="center" ng-click="closeThisDialog()"/></div>' ,
                    plain: true,
                    scope:$scope           
                    });
                }
                
            }

            //Block store
            else if(store.store_status.status_id == 5)
            {
                $scope.store = store;
                $scope.store_id = $scope.store.store_status.store_id;
                $scope.store_email = $scope.store.store_front_info.store_contact_email;
                $scope.store_name = $scope.store.title;
                
                ngDialog.openConfirm({            
                    template: '<div><h3 class="text-center">Store Title : {{store.title}}</h3>' +
                    '<textarea class="form-control" rows="7" placeholder="Enter message here.." data-ng-model="content"/>' +
                    '<input type="button" value="Send Mail" class="center" ng-click="StoreBlock(store_id,store_email,store_name,content);"/>' +
                    '<input type="button" value="close" class="center" ng-click="closeThisDialog()"/></div>' ,
                    plain: true,
                    scope:$scope           
                    });
            }

            //Other options
            else
            {
                alert("other");
            }
        }


        //offers by admin
        //free trail
        $scope.MakeOfferFree = function(id,email,name,free,premium)
        {
            $http.post(PATHS.api_url + 'users/store/setstorestatus/Accept'
                , {
                    data: {
                        storeId: id,
                        storeEmail: email,
                        storeName: name,
                        storeSubscription_id: 1,
                        storeSubscription_type: "Free Trail",
                        freeprice: free,
                        premiumprice: premium
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                ngDialog.closeAll();
                toastr.success(data.message, 'Store');
                $scope.GetAllStores();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
            });
        }

        //premium
        $scope.MakeOfferPre = function(id,email,name,premium)
        {
            $http.post(PATHS.api_url + 'users/store/setstorestatus/Accept'
                , {
                    data: {
                        storeId: id,
                        storeEmail: email,
                        storeName: name,
                        storeSubscription_id: 2,
                        storeSubscription_type: "Premium",
                        premiumprice: premium
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                ngDialog.closeAll();
                toastr.success(data.message, 'Store');
                $scope.GetAllStores();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
            });
        }

        //customized
        $scope.MakeOfferCustom = function(id,email,name,customized)
        {
            $http.post(PATHS.api_url + 'users/store/setstorestatus/Accept'
                , {
                    data: {
                        storeId: id,
                        storeEmail: email,
                        storeName: name,
                        storeSubscription_id: 3,
                        storeSubscription_type: "Customized",
                        customizedprice: customized
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                ngDialog.closeAll();
                toastr.success(data.message, 'Store');
                $scope.GetAllStores();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
            });
        }
        //offers ends


        $scope.StoreBlock = function(id,email,name,content)
        {
            $http.post(PATHS.api_url + 'users/store/setstorestatus/Reject'
                , {
                    data: {
                        storeId: id,
                        storeEmail: email,
                        storeName: name,
                        EmailContent: content
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                ngDialog.closeAll();
                toastr.success(data.message, 'Store');
                $scope.GetAllStores();

            }).error(function (data) {
                toastr.error('Status update failed, Please try again later');
            });
        }
        /*$scope.UpdateStoreStatus = function(store)
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
        }*/
        $scope.GetAllStoreStatusEnums();
    });