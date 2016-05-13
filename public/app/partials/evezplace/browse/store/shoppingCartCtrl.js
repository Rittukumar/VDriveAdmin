/**
 * Created by vishu on 06/11/15.
 */


evezownApp.controller('ShoppingCartCtrl', function ($scope, $cookieStore, StoreService,
                                                    usSpinnerService, $http, ngTableParams, $rootScope, ngFabForm,
                                                    PATHS, $location, localStorageService, $routeParams, $filter) {




    $scope.orderSuccess = function (){

        if($rootScope.checkOutType == 'cart'){

            angular.forEach($scope.shoppingCartItems, function(value, key) {

                if(value.storeId == $rootScope.storeId) {
                    $scope.shoppingCartItems.splice(key, 1);
                }
            });

            if($scope.shoppingCartItems.length > 0)
            { 

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

                localStorageService.clearAll();
                $rootScope.$broadcast('shoppingCartItems', {message: null});
                if($cookieStore.get('userId'))
                {
                    var cart_data = { user_id : $cookieStore.get('userId')};
                    $http.post(PATHS.api_url + 'cart/deletecart', cart_data)
                    
                }
            }
        }else{
            $cookieStore.remove('expressBuyItems');
        }

        location.reload(); 
        
        $location.path('/order-success');

    };



    $scope.init = function () {

        if ($routeParams.checkOutType == 'cart') {

            $rootScope.checkOutType  = $routeParams.checkOutType;
            $scope.shoppingCartItems = StoreService.getShoppingCartItems();
            
            var selectedStore = $filter('filter')($scope.shoppingCartItems, {storeId: $routeParams.storeId}, true);

            if (selectedStore.length > 0) 
            {
              $rootScope.storeId  = $routeParams.storeId;
            }

            if ($routeParams.status == 'success') {

                $scope.orderSuccess();

            }else if ($routeParams.status == 'fail') {

                $location.path('/store/browse');

            }

        }else if ($routeParams.checkOutType == 'buy') {

            $rootScope.checkOutType  = $routeParams.checkOutType;
            $scope.shoppingCartItems = $cookieStore.get('expressBuyItems') || [];

            var selectedStore = $filter('filter')($scope.shoppingCartItems, {storeId: $routeParams.storeId}, true);

            if (selectedStore.length > 0) 
            {
              $rootScope.storeId  = $routeParams.storeId;
            }

            if ($routeParams.status == 'success') {
                
                $scope.orderSuccess();

            }else if ($routeParams.status == 'fail') {

                $location.path('/store/browse');

            }

        }
    };

    $scope.init();

    $rootScope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty();

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

    //$scope.CartDetails="opacity:0.6;pointer-events:none;";

    $scope.PaymentOptions = false;//true;

    $scope.CashOnDelivery = false;

    $scope.ChequePayment = false;

    $scope.PayOnline = false;//true;

    $scope.BankPayment = false;

    $scope.PayUmoney = false;

    $scope.orderData = {};

    $scope.orderData.orders = [];
    $scope.orderAmount=0;
    $scope.productInfo = "";

    $scope.orderData.buyer = {};
    $scope.orderData.billing_address = {};
    $scope.orderData.shipping_address = {};

    $scope.orderData.buyer.email = "";
    $scope.orderData.buyer.name  = "";
    $scope.orderData.buyer.phone = "";

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

    $scope.orderData.userId  = "";
    $scope.orderData.buyerId = ""; 
    $scope.orderData.chequeNumber = "";
    $scope.orderData.chequeDate   = "";
    $scope.orderData.paymentMode  = "";
    $scope.orderData.checkOutType = $rootScope.checkOutType;

    $scope.chequeNumber = "";
    $scope.chequeDate   = "";

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
        $scope.total_price = 0;
        $scope.shoppingCartCount = 0;

        $rootScope.isShoppingCartEmpty = StoreService.isShoppingCartEmpty;

        angular.forEach($scope.shoppingCartItems, function(value) {
            $scope.shopPrice = 0; $scope.price = 0;
            angular.forEach(value.products, function(product) {
                $scope.price      =  (+product.price * +product.quantity);
                $scope.shopPrice +=  $scope.price
                $scope.totalPrice =  +$scope.totalPrice +  $scope.price;
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            value.total_price = $scope.shopPrice;
            if(value.storeId == $rootScope.storeId){
              $scope.total_price = $scope.shopPrice;
            }
            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });

        if($type == 'cart'){
            
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
        $scope.total_price = 0;
        $scope.shoppingCartCount = 0;

        $scope.isShoppingCartEmpty = !($scope.shoppingCartItems.length > 0);
        
        angular.forEach($scope.shoppingCartItems, function(value) {
            $scope.shopPrice = 0; $scope.price = 0;
            angular.forEach(value.products, function(product) {
                $scope.price      =  (+product.price * +product.quantity);
                $scope.shopPrice +=  $scope.price
                $scope.totalPrice =  +$scope.totalPrice +  $scope.price;
                //$scope.totalShipping = +$scope.totalShipping + +product.shippingCharge;
            });
            value.total_price = $scope.shopPrice;
            if(value.storeId == $rootScope.storeId){
              $scope.total_price = $scope.shopPrice;
            }

            $scope.shoppingCartCount = +$scope.shoppingCartCount + +value.products.length;
        });
         
        if($type == 'cart'){
            
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

    }


    $scope.$watch('shoppingCartItems', function () {
        onQuantityChange($rootScope.checkOutType);
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
            $scope.PayUmoney = false;
        }
        else if(SelectedPaymentMethod == "ChequePayment")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = true;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
            $scope.PayUmoney = false;
        }
        else if(SelectedPaymentMethod == "PayOnline")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = true;
            $scope.BankPayment = false;
            $scope.PayUmoney = false;
        }
        else if(SelectedPaymentMethod == "BankPayment")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = true;
            $scope.PayUmoney = false;
        }
        else if(SelectedPaymentMethod == "PayUmoney")
        {
            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
            $scope.PayUmoney = true;
        }
    };


    $scope.GetIndex = function (index) {

        if (index == 0) {
            //alert(index);
            $scope.currentSection0 = 'active';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'inactive';
            $scope.currentSection4 = 'inactive';

            $scope.CashOnDelivery = true;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
            $scope.PayUmoney = false;
        }
        if (index == 1) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'active';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'inactive';
            $scope.currentSection4 = 'inactive';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = true;
            $scope.PayUmoney = false;
        }
        if (index == 2) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'active';
            $scope.currentSection3 = 'inactive';
            $scope.currentSection4 = 'inactive';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = true;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
            $scope.PayUmoney = false;
        }
        if (index == 3) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'active';
            $scope.currentSection4 = 'inactive';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = true;
            $scope.BankPayment = false;
            $scope.PayUmoney = false;
        }
        if (index == 4) {
            //alert(index);
            $scope.currentSection0 = 'inactive';
            $scope.currentSection1 = 'inactive';
            $scope.currentSection2 = 'inactive';
            $scope.currentSection3 = 'inactive';
            $scope.currentSection4 = 'active';

            $scope.CashOnDelivery = false;
            $scope.ChequePayment = false;
            $scope.PayOnline = false;
            $scope.BankPayment = false;
            $scope.PayUmoney = true;
        }
        //$scope.currentIndex = index;
    }

    $scope.GetIndex(0);


    $scope.SubmitPayment= function(src) { 
        var isValidated = true;
        if (src == 3){
            if(!$scope.orderData.chequeNumber){
                isValidated = false;
                toastr.error('Please enter cheque number');
            }else if(!$scope.orderData.chequeDate){
                isValidated = false;
                toastr.error('Please enter cheque date');
            }
           $scope.orderData.chequeNumber = $scope.orderData.chequeNumber;
           $scope.orderData.chequeDate   = $scope.orderData.chequeDate.startDate;
        }
       if(isValidated) {
                $scope.orderData.paymentMode  = src;
                StoreService.placeOrder($scope.orderData).
                then(function (data) {
                    console.log(data);
                    $scope.orderSuccess();
                },
                function (data) {
                    toastr.error('Order Failed');
                });

            }
            
    };


    $scope.payuSubmit = function($event) {
      
      $event.preventDefault();

      var $data = {
            'email'  : $scope.orderData.buyer.email,
            'orders' : $scope.orderData
        }

        $http.post(PATHS.api_url + 'orders/paymentOrders', $data)
            .success(function(response){

               $('form[name="payuForm"]')[0].submit();
                
            }).error(function (response)
            {
               toastr.error('Please Try Again Later!');
               
            });
            
    }
  

    $scope.prepareBuyObject = function(){
        angular.forEach($scope.shoppingCartItems, function (value) {

            if(value.storeId == $rootScope.storeId){

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
                    variants: product.variants,
                    image: product.image,
                    isCollapsed: true
                };

                order.totalAmount = +order.totalAmount + (+orderProduct.price * +orderProduct.quantity);
                order.orderItems.push(orderProduct);
            });
            
            $scope.orderData.orders.push(order);
            
            }
        });
    };


    $scope.submitOrder = function () {
       
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
            
            if($cookieStore.get('userId'))
            {          
               $scope.orderData.userId  = $cookieStore.get('userId');
               $scope.prepareOrderData();

            }else{
              
               $scope.createBuyer();
              
            }

        }
    }


    $scope.createBuyer = function()
    {
        var $data = {
            'email' : $scope.orderData.buyer.email,
            'phone' : $scope.orderData.buyer.phone,
            'code'  : $scope.orderData.buyer.code
        }

        $http.post(PATHS.api_url + 'buyer/createbuyer', $data)
            .success(function(response){
                console.log(response);
                $rootScope.buyerId       = response.buyer;
                $scope.orderData.buyerId = $rootScope.buyerId;
                
            }).then(function(response) {
               
               $scope.prepareOrderData();
               
            });
    };


    $scope.prepareOrderData = function()
    {
        $scope.prepareBuyObject();
        $scope.orderAmount    = $scope.orderData.orders[0].totalAmount;
        $scope.productInfo    = $scope.orderData.orders[0].orderItems[0].title;
        $scope.transactions   = $scope.makeUniqeId();
        $scope.PaymentOptions = true;
        $scope.CartDetails    = "opacity:0.6;pointer-events:none;";
        $scope.getHash();

    };


    $scope.makeUniqeId = function()
    {
        var text = "";
        var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        for( var i=0; i < 5; i++ )
            text += possible.charAt(Math.floor(Math.random() * possible.length));

        return text;
    }


    $scope.getHash = function()
    {
          $scope.surl = "http://localhost:8000/v1/paymentstatus/paymentstatus";
          $scope.furl = "http://localhost:8000/v1/paymentstatus/paymentstatus";
          $scope.curl = "http://localhost:8000/v1/paymentstatus/paymentstatus";
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
              //$scope.orderData.orders=[];

          }).error(function (data)
          {

          }).then(function()
          {

          });

    }


    $scope.onSubmit = function () {

        $scope.processing = true;

    };


    $scope.stripeCallback = function (code, result) {

        $scope.hideAlerts();

        if (result.error) {

            $scope.stripeError = result.error.message;

        } else {

            var customer_stripe_id = ''; var customer_id = ''; var type = '';

            if($cookieStore.get('userId'))
            {          
               customer_id = $cookieStore.get('userId');
               type        = 'user';
            }else{
               customer_id = $rootScope.buyerId; 
               type        = 'buyer';
            }

            $scope.orderData.paymentMode   = 4;

            var $payInfo = {
               'token'              : result.id,
               'orders'             : $scope.orderData,
               'total'              : $scope.orderData.orders[0].totalAmount,
               'customer_stripe_id' : customer_stripe_id,
               'customer_id'        : customer_id,
               'type'               : type
            };

            $http.post(PATHS.api_url + 'payment/stripePayment', $payInfo).success(function(data){console.log(data);
                $scope.processing = false;
                if(data.status = 'OK'){
                   $scope.stripeSuccess = 'Payment Sucess,Your Order Placed Succesfully!';
                   $scope.orderSuccess();
                }else{
                   $scope.stripeSuccess = 'Payment Error,Your Order Could Not Placed!';;
                }
            });
            
        }
    };


    $scope.hideAlerts = function () {
        $scope.stripeError = null;
        $scope.stripeSuccess = null;
    };




});

