'use strict';

/**
 * @ngdoc function
 * @name appApp.controller:BuyerOrdersCtrl
 * @description
 * # BuyerOrdersCtrl
 * Controller of the appApp
 */
evezownApp
  .controller('BuyerOrdersCtrl', function ($scope,$http,PATHS,$cookieStore,OrderService,$window,$crypthmac) {
      $scope.orders = [];
      $scope.statuses = [];
      $scope.MERCHANT_KEY = "504L8L";
      $scope.Merchant_Id = "4932989";
      $scope.SALT = "mq3ogjpS";
      $scope.surl = "http://evezown.com/success";
      $scope.furl = "http://evezown.com/failure";
      $scope.PAYU_BASE_URL = "https://test.payu.in/_payment";
      $scope.loggedInUserId = $cookieStore.get('userId');
      $scope.service_url = PATHS.api_url;
      $scope.usertoken = $cookieStore.get('userToken');
      $scope.encrypttext = "";
      $scope.GetOrderByBuyer = function (input)
      {
          OrderService.getBuyerOrder(input, $scope.usertoken).then(function (data)
          {
              $scope.orders = data;
              $scope.GetCurrentStatus();
          });
      }

      $scope.GetCurrentStatus = function()
      {
          $http.get(PATHS.api_url + 'order/status/enums',
              {
                  headers: {'Authorization': 'Bearer ' + $scope.usertoken}
              }).
          success(function (data)
          {
              $scope.statuses = data;
          });
      }

      $scope.CancelOrderItem = function(orderItem,comment,orderId,input)
      {
          OrderService.updateOrderStatus(orderItem.id, '6', comment,orderItem.expected_delivery_date,orderItem.expected_shipping_date,orderId, $scope.usertoken).then(function (data)
          {
              $scope.GetOrderByBuyer(input);
              toastr.success(data.message, 'Store');
          });
      }

      $scope.getHash = function(orderItem,order)
      {

          $scope.surl = "http://evezown.com/order/"+order.transaction_id+"/success";
          $scope.furl = "http://evezown.com/order/"+order.transaction_id+"/failure";
          $scope.curl = "http://evezown.com/order/"+order.transaction_id+"/cancel";
          $scope.udf1 = "";
          $scope.udf2 = "";
          $scope.udf3 = "";
          $scope.udf4 = "";
          $scope.udf5 = "";
          $scope.udf6 = "";
          $scope.udf7 = "";
          $scope.udf8 = "";
          $scope.udf9 = "";
          $scope.udf10 = "";
          //var hashSequence = $scope.MERCHANT_KEY+"|"+order.transaction_id+"|"+orderItem.price+"|"+angular.toJson(orderItem)+"|"+order.buyer.code+"|"+order.buyer.email+"|"+order.buyer.phone+"|"+$scope.surl+"|"+$scope.furl+"|"+$scope.udf1+"|"+$scope.udf2+"|"+$scope.udf3+"|"+$scope.udf4+"|"+$scope.udf5+"|"+$scope.udf6+"|"+$scope.udf7+"|"+$scope.udf8+"|"+$scope.udf9+"|"+$scope.udf10+"|"+$scope.SALT;
          $http.post(PATHS.api_url + 'orders/payu/hash'
              , {
                  data:
                  {
                      key:$scope.MERCHANT_KEY,
                      txnid:order.transaction_id,
                      amount:orderItem.price,
                      firstname:order.buyer.code,
                      email : order.buyer.email,
                      phone : order.buyer.phone,
                      productinfo : angular.toJson(orderItem),
                      surl : $scope.surl,
                      furl :$scope.furl,
                      service_provider : "payu_paisa",
                      salt : $scope.SALT
                  },
                  headers: {'Content-Type': 'application/json'}
              }).
          success(function (data, status, headers, config)
          {
              $scope.encrypttext = data;

          }).error(function (data)
          {

          }).then(function()
          {

          });

      }

      $scope.getProductInfo = function(orderItem)
      {
          return angular.toJson(orderItem);
      }
  });
