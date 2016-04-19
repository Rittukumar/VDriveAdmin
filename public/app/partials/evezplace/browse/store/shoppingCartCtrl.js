/**
 * Created by vishu on 06/11/15.
 */


evezownApp.controller('ShoppingCartCtrl', function ($scope, $cookieStore, StoreService,
                                                    usSpinnerService, $http, ngTableParams, $rootScope, ngFabForm,
                                                    PATHS, $location, localStorageService, $routeParams) {



    $scope.init = function () {
        if ($routeParams.checkouttype == 'cart') {
            $scope.checkOutType = true;
            $scope.shoppingCartItems = StoreService.getShoppingCartItems();
        }else{
            $scope.checkOutType = false;
            $scope.shoppingCartItems = $cookieStore.get('expressBuyItems') || [];
        }
    };

    $scope.init();

    $scope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty();

    //$scope.Store_ID = $scope.expressBuyItems[0].storeId;
     
    $scope.imageUrl = PATHS.api_url;

    $scope.date = new Date();

    $scope.defaultFormOptions = ngFabForm.config;

    $scope.customFormOptions = angular.copy(ngFabForm.config);

    $scope.isOrderSuccess = false;

    $scope.loggedInUser = $cookieStore.get('userId');

    if($scope.loggedInUser)
    {
        $scope.EmailEdit = false;
        $scope.AddressEdit = false;
    }
    else
    {
        $scope.EmailEdit = true;
        $scope.AddressEdit = true;
    }

    $scope.PaymentOptions = false;

    $scope.CashOnDelivery = false;

    $scope.ChequePayment = false;

    $scope.PayOnline = false;

    $scope.BankPayment = false;

    $scope.orderData = {};

    $scope.orderData.orders = [];
    $scope.orderAmount=0;
    $scope.productInfo = "";

    $scope.orderData.buyer = {};
    $scope.orderData.billing_address = {};
    $scope.orderData.shipping_address = {};

    $scope.orderData.billing_address.addressLine1 = "";
    $scope.orderData.billing_address.city = "";
    $scope.orderData.billing_address.state = "";
    $scope.orderData.billing_address.country = "";
    $scope.orderData.billing_address.pincode = "";

    $scope.orderData.shipping_address.addressLine1 = "";
    $scope.orderData.shipping_address.city = "";
    $scope.orderData.shipping_address.state = "";
    $scope.orderData.shipping_address.country = "";
    $scope.orderData.shipping_address.pincode = "";

    $scope.orderData.user = "";

    //Production Server setting
    $scope.MERCHANT_KEY = "MtAc0u";
    $scope.Merchant_Id = "5212138";
    $scope.SALT = "09BHBbap";
    $scope.PAYU_BASE_URL = "https://secure.payu.in/_payment";

    $scope.surl = "http://evezown-api-dev.elasticbeanstalk.com/public/paymentstatus/paymentstatus";
    $scope.furl = "http://evezown-api-dev.elasticbeanstalk.com/public/paymentstatus/paymentstatus";
    $scope.loggedInUserId = $cookieStore.get('userId');
    $scope.service_url = PATHS.api_url;
    $scope.usertoken = $cookieStore.get('userToken');
    $scope.encrypttext = "";

    
    

    $scope.getUserDetails = function ($userId) {
        
        $http.get(PATHS.api_url +  'users/' + $userId)
            .success(function(data){
                $scope.orderData.buyer.email = data.data.email;
                $scope.orderData.buyer.name = data.data.firstname + data.data.lastname;
                $scope.orderData.buyer.phone = data.data.phone;

                $scope.orderData.billing_address.addressLine1 = data.data.street_address;
                $scope.orderData.billing_address.city = data.data.city;
                $scope.orderData.billing_address.state = data.data.state;
                $scope.orderData.billing_address.country = data.data.country;
                $scope.orderData.billing_address.pincode = data.data.pincode;

                $scope.orderData.shipping_address.addressLine1 = data.data.street_address;
                $scope.orderData.shipping_address.city = data.data.city;
                $scope.orderData.shipping_address.state = data.data.state;
                $scope.orderData.shipping_address.country = data.data.country;
                $scope.orderData.shipping_address.pincode = data.data.pincode;

            })
            .error(function(err){
                console.log('Error retrieving user');
            });
    }

    if($cookieStore.get('userId')){
      $scope.getUserDetails($scope.loggedInUser);
    }
    
    $scope.removeFromCart = function ($productid, $type) {
        
        angular.forEach($scope.shoppingCartItems, function(value, key) {

            angular.forEach(value.products, function (v, k) {

                if(v.product_id == $productid){
                   value.products.splice(k, 1);
                }
            });
            
            if(value.products.length == 0) {
                $scope.shoppingCartItems.splice(key, 1);
            }
        });

        //localStorageService.set('shoppingCartItems', $scope.shoppingCartItems);

        $scope.totalPrice = 0;
        $scope.totalShipping = 0;

        $scope.shoppingCartCount = 0;

        $scope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty;

        angular.forEach($scope.shoppingCartItems, function(value) {
            angular.forEach(value.products, function(product) {
                $scope.totalPrice =  +$scope.totalPrice +  (+product.price * +product.quantity);
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            value.total_price = $scope.totalPrice;
            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });

        if($type){
            
            localStorageService.remove('shoppingCartItems');
            localStorageService.set('shoppingCartItems', $scope.shoppingCartItems);
            $rootScope.$broadcast('shoppingCartItems', {message: $scope.shoppingCartItems});
            
            if($cookieStore.get('userId')){
                var cart_data = {
                                    cart_contents : $scope.shoppingCartItems,
                                    user_id       : $cookieStore.get('userId')
                                };
                            
                $http.post(PATHS.api_url + 'cart/addcart', cart_data)
            }

        }else{

            if($cookieStore.get('expressBuyItems')) {
                $cookieStore.remove('expressBuyItems');
            }

            $cookieStore.put('expressBuyItems', $scope.shoppingCartItems);

            //$rootScope.$broadcast('expressBuyItems', {message: $scope.shoppingCartItems});

        }

        toastr.success('Shopping Cart', 'Product removed from cart.');
    };

    function onQuantityChange($type) {
        $scope.totalPrice = 0;
        $scope.totalShipping = 0;

        $scope.shoppingCartCount = 0;

        $scope.isShoppingCartEmpty = !($scope.shoppingCartItems.length > 0);

        angular.forEach($scope.shoppingCartItems, function(value) {
            angular.forEach(value.products, function(product) {
                $scope.totalPrice =  +$scope.totalPrice +  (+product.price * +product.quantity);
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            value.total_price = $scope.totalPrice;
            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });
         
        if($type){
            
            localStorageService.remove('shoppingCartItems');
            localStorageService.set('shoppingCartItems', $scope.shoppingCartItems);
            $rootScope.$broadcast('shoppingCartItems', {message: $scope.shoppingCartItems});
            
            if($cookieStore.get('userId')){
                console.log('vas');console.log($scope.shoppingCartItems);console.log(localStorageService.get('shoppingCartItems'));
                var cart_data = {
                                    cart_contents : $scope.shoppingCartItems,
                                    user_id       : $cookieStore.get('userId')
                                };
                            
                $http.post(PATHS.api_url + 'cart/addcart', cart_data)
            }

        }else{

            if($cookieStore.get('expressBuyItems')) {
                $cookieStore.remove('expressBuyItems');
            }

            $cookieStore.put('expressBuyItems', $scope.shoppingCartItems);

            //$rootScope.$broadcast('expressBuyItems', {message: $scope.shoppingCartItems});

        }

    }

    $scope.$watch('shoppingCartItems', function () {
        onQuantityChange($scope.checkOutType);
    }, true);

    //console.log($scope.expressBuyItems);

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

    // Copy billing to shipping address.
    $scope.copyBillingAddress = function(orderData) {
        if(orderData.isShippingEqualBilling)
            orderData.shipping_address = orderData.billing_address;
        else
            orderData.shipping_address = {};
    };

    $scope.PaymentMethod = function(SelectedPaymentMethod)
    {
        if(SelectedPaymentMethod == "CashOnDelivery")
        {
            $scope.CashOnDelivery = true;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
        }
        else if(SelectedPaymentMethod == "ChequePayment")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = true;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
        }
        else if(SelectedPaymentMethod == "PayOnline")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = true;
            $scope.BankPayment = false;
        }
        else if(SelectedPaymentMethod == "BankPayment")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = true;
        }
    };

    $scope.GetIndex = function (index) {

        if (index == 0) {
            //alert(index);
            $scope.currentSection0 = 'active';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'inactive';

            $scope.CashOnDelivery = true;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
        }
        if (index == 1) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'active';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'inactive';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = true;
        }
        if (index == 2) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'active';
            $scope.currentSection3 = 'inactive';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = true;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
        }
        if (index == 3) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'active';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = true;
            $scope.BankPayment = false;
        }
        //$scope.currentIndex = index;
    }
    $scope.GetIndex(0);

    $scope.SubmitPayment= function(src) { 
        var isValidated = true;
        //var paymentMode;
        if (src == 3){
            if(!$scope.ChequeNO){
                isValidated = false;
                toastr.error('Please enter cheque number');
            }else if(!$scope.ChequeDate){
                isValidated = false;
                toastr.error('Please enter cheque date');
            }
           
        }
       if(isValidated) {
                $http.post(PATHS.api_url + 'cheque/details'
                , {
                    data: {
                        chequeNumber: $scope.ChequeNO,
                        chequeDate: $scope.ChequeDate,
                        orderId: $rootScope.OrderID,
                        payMode: src
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).success(function(data){
                    if(data.paymentMode == 4){
                            document.payuForm.submit();
                    }else{

                         $location.path('/order-success'); 
                    }
                }).error(function (data) {
                    toastr.error('Order Failed');
                });
            }
            
    };
  

    $scope.prepareBuyObject = function(){
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
    };


    $scope.submitOrder = function ($type) {
       
        console.log($scope.orderData);

        //validations - buyer info
        if(!$scope.orderData.buyer.name)
        {
            toastr.error('Please enter buyer name');
        }
        else if(!$scope.orderData.buyer.email)
        {
            toastr.error('Please enter buyer email');
        }
        else if(!$scope.orderData.buyer.phone)
        {
            toastr.error('Please enter buyer phone number');
        }

        //validations - billing address
        else if(!$scope.orderData.billing_address.addressLine1)
        {
            toastr.error('Please enter address' , "Billing");
        }
        else if(!$scope.orderData.billing_address.city)
        {
            toastr.error('Please enter city', "Billing");
        }
        else if(!$scope.orderData.billing_address.state)
        {
            toastr.error('Please enter state', "Billing");
        }
        else if(!$scope.orderData.billing_address.country)
        {
            toastr.error('Please enter country', "Billing");
        }
        else if(!$scope.orderData.billing_address.pincode)
        {
            toastr.error('Please enter pincode', "Billing");
        }

        //validations - shipping address
        else if(!$scope.orderData.shipping_address.addressLine1)
        {
            toastr.error('Please enter address', "Shipping");
        }
        else if(!$scope.orderData.shipping_address.city)
        {
            toastr.error('Please enter city', "Shipping");
        }
        else if(!$scope.orderData.shipping_address.state)
        {
            toastr.error('Please enter state', "Shipping");
        }
        else if(!$scope.orderData.shipping_address.country)
        {
            toastr.error('Please enter country', "Shipping");
        }
        else if(!$scope.orderData.shipping_address.pincode)
        {
            toastr.error('Please enter pincode', "Shipping");
        }

        else
        {
            $scope.prepareBuyObject();
            $scope.orderAmount = $scope.orderData.orders[0].totalAmount;
            $scope.productInfo = $scope.orderData.orders[0].orderItems[0].title;
            if($cookieStore.get('userId'))
            {          
               $scope.orderData.user = $cookieStore.get('userId');
            }
            StoreService.placeOrder($scope.orderData).
                then(function (data) {
                    console.log(data);
                    $rootScope.OrderID = data.orderId;
                    if($type){
                        localStorageService.clearAll();
                        $rootScope.$broadcast('shoppingCartItems', {message: null});
                        if($cookieStore.get('userId'))
                        {
                            var cart_data = { user_id : $cookieStore.get('userId')};
                            $http.post(PATHS.api_url + 'cart/deletecart', cart_data)
                        }
                    }else{
                        $cookieStore.remove('expressBuyItems');
                    }
                    
                    $scope.transactions = data.transactions[0];
                    $scope.PaymentOptions=true;
                    $scope.CartDetails="opacity:0.6;pointer-events:none;";
                    $scope.getHash();
                },
                function (data) {
                    toastr.error(data.error.message.message, 'Submit Order')
                });
        }
    }

     $scope.getHash = function()
      {
          $scope.surl = "http://evezown-api-dev.elasticbeanstalk.com/public/paymentstatus/paymentstatus";
          $scope.furl = "http://evezown-api-dev.elasticbeanstalk.com/public/paymentstatus/paymentstatus";
          $scope.curl = "http://evezown-api-dev.elasticbeanstalk.com/public/paymentstatus/paymentstatus";
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
          $http.post(PATHS.api_url + 'orders/payu/hash'
              , {
                  data:
                  {
                      key:$scope.MERCHANT_KEY,
                      txnid:$scope.transactions,
                      amount:$scope.orderAmount,
                      firstname:$scope.orderData.buyer.name,
                      email : $scope.orderData.buyer.email,
                      phone : $scope.orderData.buyer.phone,
                      productinfo : $scope.productInfo,
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
              $scope.orderData.orders=[];

          }).error(function (data)
          {

          }).then(function()
          {

          });

      }





});

