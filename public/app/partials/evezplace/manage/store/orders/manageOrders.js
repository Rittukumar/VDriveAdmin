/**
 * Created by vishu on 06/11/15.
 */
evezownApp
    .controller('ManageOrdersCtrl', function ($scope,$http,PATHS,$cookieStore,OrderService) {
        $scope.orders = [];
        $scope.service_url = PATHS.api_url;
        $scope.usertoken = $cookieStore.get('userToken');
        $scope.UpdateOrder = {};
        $scope.UpdateOrder.selectedItemStatus = null;
        $scope.UpdateOrder.orderComment = "";
        $scope.orderstatuses = [];
        $scope.isCollapsed = true;
        $scope.title = 'Manage';

        $scope.GetAllOrdersByUser = function () {
            $http.get(PATHS.api_url + 'orders',
                {
                    headers: {'Authorization': 'Bearer ' + $scope.usertoken}
                }).
            success(function (data)
            {
                $scope.orders = data.data;
            }).then(function (data)
            {
                $scope.GetStatus();
            });
        }

        $scope.GetStatus = function () {

            $http.get(PATHS.api_url + 'order/status/enums',
                {
                    headers: {'Authorization': 'Bearer ' + $scope.usertoken}
                }).
            success(function (data) {
                $scope.orderstatuses = data;

                if (!$scope.UpdateOrder.selectedItemStatus) {
                    if ($scope.orderstatuses.length > 0) {
                        $scope.UpdateOrder.selectedItemStatus = $scope.orderstatuses[0];
                    }

                }

            });
        }


        $scope.UpdateOrderItem = function (itemId, statusId, comment,deliveryDays,shippingDays,orderId)
        {
            OrderService.updateOrderStatus(itemId, statusId, comment,deliveryDays,shippingDays,orderId, $scope.usertoken).then(function (data)
            {
                $scope.GetAllOrdersByUser();
                toastr.success(data.message, 'Store');
            });
        }

        $scope.$watch('UpdateOrder.selectedItemStatus', function(newvalue,oldvalue)
        {
            $scope.UpdateOrder.selectedItemStatus = newvalue;
        });



        $scope.GetCurrentStatus = function(currentStatusId)
        {
            var current = null;
            if(currentStatusId)
            {
                angular.forEach($scope.orderstatuses, function (value, key)
                {
                    if(value.id == currentStatusId)
                    {
                        current = value;
                    }
                });
            }
            else
            {
                current = $scope.orderstatuses[0];
            }

            return current.id;
        }

        $scope.GetDateFromDays = function(days)
        {
            var someDate = new Date();
            var currentDate = new Date();
            if(!days)
            {
                days = 0;
            }
            var numberOfDaysToAdd = parseInt(days);
            currentDate.setDate(someDate.getDate() + numberOfDaysToAdd);
            console.log(numberOfDaysToAdd);
            var dd = currentDate.getDate();
            var mm = currentDate.getMonth();
            var y = currentDate.getFullYear();

            var someFormattedDate = dd + '/'+ mm + '/'+ y;

            return someFormattedDate;
        }

        $scope.GetDateDifference = function(date)
        {
            var date1 = new Date();
            var date2 = new Date(date);
            var timeDiff = Math.abs(date2.getTime() - date1.getTime());
            var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

            return diffDays;
        }

        $scope.GetDateFromDaysUnformatted = function(days)
        {
            var someDate = new Date();
            var currentDate = new Date();
            if(!days)
            {
                days = 0;
            }
            var numberOfDaysToAdd = parseInt(days);
            currentDate.setDate(someDate.getDate() + numberOfDaysToAdd);
            var dd = currentDate.getDate();
            var mm = currentDate.getMonth();
            var y = currentDate.getFullYear();
            var dateOnly = new Date(y,mm,dd);
            return dateOnly;
        }

        $scope.GetAllOrdersByUser();

    });