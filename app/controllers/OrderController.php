<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class OrderController extends AppController
{

    /**
     * @return string
     */
    public function getBuyerDetails()
    {
        $email = Input::get('email', '');
        $phone = Input::get('phone', '');
        $code = Input::get('code', '');

        $buyer = Buyer::with('billingAddress', 'shippingAddress')->where('email', $email)
            ->orWhere('phone', $phone)
            ->orWhere('code', $code)->first();

        $fractal = new Manager();

        $buyerResource = new Item($buyer, new BuyerTransformer());

        $data = $fractal->createData($buyerResource);

        return $data->toJson();
    }

    /**
     * Display a listing of the resource.
     * GET /order
     *
     * @param string $status
     * @return Response
     */
    public function index()
    {
        try {

            if (!$user = JWTAuth::parseToken()->toUser()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        $status = Input::get('status', 'placed');

        $orderStatusToQuery = OrderStatusEnum::where('status', $status)->first();

        $orders = Order::with('orderItems.productSku.ProductImages.image',
            'orderItems.productSku.product', 'orderItems.orderItemStatus', 'currentOrderStatus', 'orderStatusHistories')
            ->where('current_status_id', $orderStatusToQuery->id)
            ->whereExists(function ($query) use ($user) {
                $query->select(DB::raw(1))
                    ->from('stores')
                    ->whereRaw('stores.id = orders.store_id')
                    ->whereRaw('stores.owner_id = ' . $user->id);
            })->orderBy('created_at', 'DESC')->get();


        $fractal = new Manager();

        $ordersResource = new Collection($orders, new OrderTransformer());

        $data = $fractal->createData($ordersResource);

        return $data->toJson();
    }

    /**
     * Display a listing of the resource.
     * GET /order
     *
     * @param string $status
     * @return Response
     */
    public function getBuyersOrder($input)
    {
        $orders = null;
        $buyer = Buyer::where('email', $input)
            ->orWhere('phone', $input)
            ->orWhere('code', $input)
            ->first();

        if ($buyer) {
            $orders = Order::with('orderItems.productSku.ProductImages.image',
                'orderItems.productSku.product', 'orderItems.orderItemStatus',
                'currentOrderStatus', 'orderStatusHistories')
                ->where('buyer_id', $buyer->id)
                ->orderBy('created_at', 'DESC')->get();
        } else {

            $orders = Order::with('orderItems.productSku.ProductImages.image',
                'orderItems.productSku.product', 'orderItems.orderItemStatus',
                'currentOrderStatus', 'orderStatusHistories')
                ->where('transaction_id', $input)
                ->orderBy('created_at', 'DESC')->get();
        }

        $fractal = new Manager();

        $ordersResource = new Collection($orders, new OrderTransformer());

        $data = $fractal->createData($ordersResource);

        return $data->toJson();
    }


    public function createBuyer(){

        try{
            
            $buyerName  = Input::get('name');
            $buyerEmail = Input::get('email');
            $buyerPhone = Input::get('phone');
            $buyerCode  = Input::get('code');

            $buyer = Buyer::where('email', $buyerEmail)
                            ->orWhere('phone', $buyerPhone)
                            ->orWhere('code', $buyerCode)->first();

            if (!$buyer) {

                $code = 'EvezownBuyer-'.$this->getRandomString();

                $buyer = Buyer::create([
                    'name'  => $buyerName,
                    'email' => $buyerEmail,
                    'phone' => $buyerPhone,
                    'code'  => $code
                ]);

                if($buyer){

                    $data = array(
                    'buyerName'  => $buyer['name'],
                    'buyerEmail' => $buyer['email'],
                    'buyerPhone' => $buyer['phone'],
                    'code'       => $code,
                    );

                    Mail::send('emails.buyercode', $data, function ($message) use ($buyer) {
                        $message->from('editor@evezown.com', 'Evezown Admin');
                        $message->to($buyer['email'], $buyer['email'])->subject('Your Buyer Code!');
                    });

                }

            } else {
                
                $buyer->name  = $buyerName;
                $buyer->email = $buyerEmail;
                $buyer->phone = $buyerPhone;

                $buyer->save();
            }

            $successResponse = [
                'status'  => true,
                'buyer'   => $buyer->id
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        }catch (Exception $e){

            return $this->setStatusCode(500)->respondWithError($errorMessage);

        }

    }

    /**
     * Show the form for creating a new resource.
     * GET /order/create
     *
     * @return Response
     */
    public function store()
    {

        try {

            $inputArray = Input::all();

            $orders = $this->saveOrders($inputArray, '');

             $successResponse = [
                'status'  => true,
                'orders'  => $orders
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            $errorMessage = [
                'status' => false,
                'message' => 'Submit order failed. Please try again.'
            ];

            //return $this->setStatusCode(500)->respondWithError($errorMessage);
            return $e;
        }
    }


    public function saveOrders($orders, $stripe_payment_details){

        try{

            $inputArray = $orders;
           
            $billingAddress  = ($inputArray['billing_address'] != null) ? $inputArray['billing_address'] : '';

            $shippingAddress = ($inputArray['shipping_address'] != null) ? $inputArray['shipping_address'] : '';

            $saved_orders = [];

            $userId       = $inputArray['userId'];
            $buyerId      = $inputArray['buyerId'];
            $buyerArray   = isset($inputArray['buyer']) ? $inputArray['buyer'] : '';
            $buyerEmail   = isset($buyerArray['email']) ? $buyerArray['email'] : '';
            $buyerPhone   = isset($buyerArray['phone']) ? $buyerArray['phone'] : '';
            $buyerCode    = isset($buyerArray['code']) ? $buyerArray['code'] : '';
            $chequeNumber = $inputArray['chequeNumber'];
            $chequeDate   = $inputArray['chequeDate'];
            $paymentMode  = $inputArray['paymentMode'];

            if(empty($userId))
            {
                $customerKey   = 'buyer_id';
                $customerValue =  $buyerId;

            }else{

                $customerKey   = 'user_id';
                $customerValue =  $userId;
            }

               //Method to save the billing and the shipping address.
                if ($billingAddress == '') {
                    $errorMessage = [
                    'status' => false,
                    'message' => 'Please provide billing address for product'
                            ];
                    return $this->setStatusCode(404)->respondWithError($errorMessage);
                }
                
                if ($shippingAddress == '') {
                    $errorMessage = [
                    'status' => false,
                    'message' => 'Please provide shipping address for product'
                            ];
                    return $this->setStatusCode(404)->respondWithError($errorMessage);
                }


                if(isset($billingAddress['id']))
                {
                    $orderBillingAddress = OrderBillingAddress::find($billingAddress['id']);
                }
                else
                {
                    $orderBillingAddress = new OrderBillingAddress;
                }
                   $orderBillingAddress->$customerKey   = $customerValue;
                   $orderBillingAddress->address_line1  = isset($billingAddress['address_line1']) ? $billingAddress['address_line1'] : '';
                   $orderBillingAddress->address_line2  = isset($billingAddress['address_line2']) ? $billingAddress['address_line2'] : '';
                   $orderBillingAddress->address_line3  = isset($billingAddress['address_line3']) ? $billingAddress['address_line3'] : '';
                   $orderBillingAddress->city           = isset($billingAddress['city']) ? $billingAddress['city'] : '';
                   $orderBillingAddress->state          = isset($billingAddress['state']) ? $billingAddress['state'] : '';
                   $orderBillingAddress->country        = isset($billingAddress['country']) ? $billingAddress['country'] : '';
                   $orderBillingAddress->pincode        = isset($billingAddress['pincode']) ? $billingAddress['pincode'] : '';


                if(isset($shippingAddress['id']))
                {
                    $orderShippingAddress = OrderBillingAddress::find($shippingAddress['id']);
                }
                else
                {
                    $orderShippingAddress = new OrderBillingAddress;
                }
                   $orderShippingAddress->$customerKey   = $customerValue;
                   $orderShippingAddress->address_line1  = isset($shippingAddress['address_line1']) ? $shippingAddress['address_line1'] : '';
                   $orderShippingAddress->address_line2  = isset($shippingAddress['address_line2']) ? $shippingAddress['address_line2'] : '';
                   $orderShippingAddress->address_line3  = isset($shippingAddress['address_line3']) ? $shippingAddress['address_line3'] : '';
                   $orderShippingAddress->city           = isset($shippingAddress['city']) ? $shippingAddress['city'] : '';
                   $orderShippingAddress->state          = isset($shippingAddress['state']) ? $shippingAddress['state'] : '';
                   $orderShippingAddress->country        = isset($shippingAddress['country']) ? $shippingAddress['country'] : '';
                   $orderShippingAddress->pincode        = isset($shippingAddress['pincode']) ? $shippingAddress['pincode'] : '';
                

            $i = -1;

            // Create Orders
            foreach ($inputArray['orders'] as $inputs) {

                $storeId     = $inputs['storeId'];
                $totalAmount = $inputs['totalAmount'];
                $items       = $inputs['orderItems'];
                

                $order = Order::create([
                    'store_id'          => $storeId,
                    $customerKey        => $customerValue,
                    'transaction_id'    => 'Evezown-'.$this->getRandomString('alnum', 5),
                    'current_status_id' => 1, //Order status will be 1 if order is just placed
                    'total_amount'      => $totalAmount,
                    'billing_id'        => $orderBillingAddress->id,
                    'shipping_id'       => $orderShippingAddress->id
                ]);
                
                $i++;
                $transactionIds[$i] = $order['transaction_id'];


                    // Insert order status history (status = 'placed')
                    $orderStatusHistory = new OrderStatusHistory([
                        'status_id' => 1
                    ]);

                    $order->orderStatusHistories()->save($orderStatusHistory);

                    // Insert order Items 
                    foreach ($items as $value) {
                        $newOrderItem = new OrderItem([
                            'product_id' => $value['product_id'],
                            'quantity'   => $value['quantity'],
                            'price'      => $value['price'],
                            'color'      => $value['variants']['color'],
                            'size'       => $value['variants']['size'],
                            'volume'     => $value['variants']['volume'],
                            'weight'     => $value['variants']['weight']
                        ]);

                        $orderItem = $order->orderItems()->save($newOrderItem);

                       // Insert order Item status history 
                        $orderItemStatus = new OrderItemStatusHistory([
                            'status_id' => 1,
                            'status_comment' => 'order placed'
                        ]);

                        $orderItem->orderItemStatus()->save($orderItemStatus);


                        //Insert Order Payment Details  
                            $orderpaymentdetails = new \OrderPayment();

                            $orderpaymentdetails->order_id        = $order->id;
                            $orderpaymentdetails->payment_mode_id = $paymentMode;
                            $orderpaymentdetails->check_dd_number = empty($chequeNumber)? '' : $chequeNumber;
                            $orderpaymentdetails->check_dd_date   = empty($chequeDate)? '' : $chequeDate;
                            $orderpaymentdetails->status          = $order->current_status_id;


                            $orderpaymentdetails->save();
                            unset($orderpaymentdetails);
                        

                        //Insert Stripe Payment Details  
                        if(!empty($stripe_payment_details)){
                            
                            $stripe_details = new \PaymentDetails();

                            $stripe_details->order_id  = $order->id;
                            $stripe_details->charge_id = $stripe_payment_details['charge_id'];
                            $stripe_details->price     = $value['price'];
                            $stripe_details->last_four = $stripe_payment_details['last_four'];
                            $stripe_details->card_type = $stripe_payment_details['card_type'];


                            $stripe_details->save();
                            unset($stripe_details);
                        }
                        
                    }


                // Send notification mail to buyer and store.
                $storeItem = Store::find($storeId);

                $transactionCode = $order['transaction_id'];

                $orderId = $order->id;

                $customer = empty($userId)?'buyer':'user';

                $order = Order::with($customer, 'orderItems.productSku.ProductImages.image',
                    'orderItems.productSku.product')->find($orderId);

                $data = array(
                    'buyerEmail' => $buyerEmail,
                    'buyerPhone' => $buyerPhone,
                    'transactionCode' => $transactionCode,
                    'order' => $order
                );

                Mail::send('emails.customerorder', $data, function ($message) use ($buyerEmail) {
                    $message->from('editor@evezown.com', 'Evezown Admin');
                    $message->to($buyerEmail, $buyerEmail)->subject('Your order placed!');
                });

                if ($storeItem->email_address != null) {
                    $store = array(
                        'email' => $storeItem->email_address
                    );

                    Mail::send('emails.store-order', $data, function ($message) use ($store) {
                        $message->from('editor@evezown.com', 'Evezown Admin');
                        $message->to($store['email'], $store['email'])->subject('You received an order!');
                    });
                }

                $saved_orders[] = $order;
            }

            if(!empty($saved_orders)){
                return 'success';
            }


        }catch (Exception $e){

            return $this->setStatusCode(500)->respondWithError($errorMessage);

        }

    }

    
    public function addBillingAndShippingAddress($billingAddress,$shippingAddress)
    {	
    	$locationResource = App::make('LocationResource');
    	try{
	    	
    	} catch (Exception $ex) {
    		return $this->setStatusCode(500)->respondWithError($ex);
    	}
    }


    function getRandomString($type = 'alnum', $length = 8)
    {
        switch ($type) {
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'hexdec':
                $pool = '0123456789abcdef';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            case 'distinct':
                $pool = '2345679ACDEFHJKLMNPRSTUVWXYZ';
                break;
            default:
                $pool = (string)$type;
                break;
        }


        $crypto_rand_secure = function ($min, $max) {
            $range = $max - $min;
            if ($range < 0) return $min; // not so random...
            $log = log($range, 2);
            $bytes = (int)($log / 8) + 1; // length in bytes
            $bits = (int)$log + 1; // length in bits
            $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
            do {
                $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
                $rnd = $rnd & $filter; // discard irrelevant bits
            } while ($rnd >= $range);
            return $min + $rnd;
        };

        $token = "";
        $max = strlen($pool);
        for ($i = 0; $i < $length; $i++) {
            $token .= $pool[$crypto_rand_secure(0, $max)];
        }
        return $token;
    }

    /**
     * Display the specified resource.
     * GET /order/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function getOrderStatusEnums()
    {
        return OrderStatusEnum::all();
    }

    /**
     * Show the form for editing the specified resource.
     * GET /order/{id}/edit
     * @return Response
     * @internal param int $id
     */
    public function updateOrderStatus()
    {
        try {
            $inputArray = Input::all();

            $orderItemId = $inputArray['order_item_id'];
            $orderId = $inputArray['order_id'];
            $statusId = $inputArray['status_id'];
            $noOfDaysForShipping = isset($inputArray['shippingDays']) ? $inputArray['shippingDays'] : '0';
            $noOfDaysForDelivery = isset($inputArray['deliveryDays']) ? $inputArray['deliveryDays'] : '0';
            $comment = isset($inputArray['comment']) ? $inputArray['comment'] : '';


            $orderItemStatus = OrderItemStatusHistory::create([
                'order_item_id' => $orderItemId,
                'status_id' => $statusId,
                'status_comment' => $comment
            ]);


            if ($orderId) {
                $orderItem = OrderItem::Where('order_id', $orderId)->first();
                if ($orderItem) {
                    $orderItem->expected_shipping_date = $noOfDaysForShipping;
                    $orderItem->expected_delivery_date = $noOfDaysForDelivery;
                    $orderItem->save();
                }
            }


//            TODO - send mail to buyer to notify.

//            $orderItem = OrderItem::find($orderItemId);
//
//            $order = $orderItem->order;
//
//            $data = array(
//                'buyerEmail' => $buyer['email'],
//                'buyerPhone' => $buyer['phone'],
//                'transactionCode' => $transactionCode,
//                'order' => $order
//            );
//
//            Mail::send('emails.customerorder', $data, function ($message) use ($buyer) {
//                $message->from('editor@evezown.com', 'Evezown Admin');
//                $message->to($buyer['email'], $buyer['email'])->subject('Your order placed!');
//            });
//
//            if ($storeItem->email_address != null) {
//                $store = array(
//                    'email' => $storeItem->email_address
//                );
//
//                Mail::send('emails.store-order', $data, function ($message) use ($store) {
//                    $message->from('editor@evezown.com', 'Evezown Admin');
//                    $message->to($store['email'], $store['email'])->subject('You received an order!');
//                });
//            }


            $successResponse = [
                'status' => true,
                'id' => $orderItemStatus->id,
                'message' => 'Order item status has been updated successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            $errorMessage = ['status' => false,
                'message' => 'Submit order failed. Please try again.'];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }


    /**
     * Show the form for editing the specified resource.
     * GET /order/{id}/edit
     * @return Response
     * @internal param int $id
     */
    public function getHash()
    {
        $input = Input::all();
        $input_array = $input['data'];
        $salt = $input_array['salt'];
        $txnid = "";
        $posted = array();
        $formError = 0;

        if (empty($input_array['txnid'])) {
            // Generate random transaction id
            $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        } else {
            $txnid = $input_array['txnid'];
        }
        $hash = '';
// Hash Sequence
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        if (empty($input_array['hash']) && sizeof($input_array) > 0) {
            if (
                empty($input_array['key'])
                || empty($input_array['txnid'])
                || empty($input_array['amount'])
                || empty($input_array['firstname'])
                || empty($input_array['email'])
                || empty($input_array['phone'])
                || empty($input_array['productinfo'])
                || empty($input_array['surl'])
                || empty($input_array['furl'])
                || empty($input_array['service_provider'])
            ) {
                $formError = 1;
            } else {
                //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
                $hashVarsSeq = explode('|', $hashSequence);
                $hash_string = '';
                foreach ($hashVarsSeq as $hash_var) {
                    $hash_string .= isset($input_array[$hash_var]) ? $input_array[$hash_var] : '';
                    $hash_string .= '|';
                }

                $hash_string .= $salt;

                $hash = strtolower(hash('sha512', $hash_string));
            }
            return $hash;
        }
    }
    
    // Order success post method.
   public function  orderSuccess(){
   		try {
   			$inputArray = Input::all();
   			$orderId = $inputArray["order_id"];
   			$orderStatus = $inputArray["status"];
   			
   			$orderpayment = OrderPayment::where('order_id', $orderId)->first();
   			if($orderStatus == "success"){
   				$orderpayment->status = "Success";
   			}else{
   				$orderpayment->status = "Failed";
   			}
   			$orderpayment->save();
   			
   			return Redirect::to('payupaymentsuccess/payupaymentsuccess');
   					   			
   			} catch (Exception $e) {
   				$errorMessage = ['status' => false,
   				'message' => 'Order failed. Please try again.'];
   			}
   }

    public function updateOrder()
    {
        try {
            $inputArray = Input::all();
            $orderId = $inputArray['order_id'];
            $statusId = $inputArray['status_id'];
            $comment = isset($inputArray['comment']) ? $inputArray['comment'] : '';

            $orderStatus = OrderStatusHistory::create([
                'order_id' => $orderId,
                'status_id' => $statusId,
                'status_comment' => $comment
            ]);
//            TODO - send mail to buyer to notify.

//            $orderItem = OrderItem::find($orderItemId);
//
//            $order = $orderItem->order;
//
//            $data = array(
//                'buyerEmail' => $buyer['email'],
//                'buyerPhone' => $buyer['phone'],
//                'transactionCode' => $transactionCode,
//                'order' => $order
//            );
//
//            Mail::send('emails.customerorder', $data, function ($message) use ($buyer) {
//                $message->from('editor@evezown.com', 'Evezown Admin');
//                $message->to($buyer['email'], $buyer['email'])->subject('Your order placed!');
//            });
//
//            if ($storeItem->email_address != null) {
//                $store = array(
//                    'email' => $storeItem->email_address
//                );
//
//                Mail::send('emails.store-order', $data, function ($message) use ($store) {
//                    $message->from('editor@evezown.com', 'Evezown Admin');
//                    $message->to($store['email'], $store['email'])->subject('You received an order!');
//                });
//            }


            $successResponse = [
                'status' => true,
                'id' => $orderStatus->id,
                'message' => 'Order status has been updated successfully'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            $errorMessage = ['status' => false,
                'message' => 'Submit order failed. Please try again.'];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }
    
    
    public function updatePaymentStatus()
    {
    	try {
    		$inputArray = Input::all();
    		$orderId = $inputArray['order_id'];
    		$paymentStatus="Success";
    		$paymentModeId = $inputArray['payment_mode_id'];
    		$checkDdNo = isset($inputArray['check_dd_no']) ? $inputArray['check_dd_no'] : null;
    		$checkDdDate = isset($inputArray['check_dd_date']) ? $inputArray['check_dd_date'] : null;
    		if($paymentModeId == 4){
    			$paymentStatus = "In Progress";
    		}
    		
    		$order = OrderPayment::create([
    				'order_id' => $orderId,
    				'payment_mode_id' => $paymentModeId,
    				'check_dd_no' => $checkDdNo,
    				'check_dd_date' => $checkDdDate,
    				'status' => $paymentStatus
    				]);
    		
    		$successResponse = [
    				'status' => true
    				];
    
    		return $this->setStatusCode(200)->respond($successResponse);
    
    	} catch (Exception $e) {
    		$errorMessage = ['status' => false];
    		return $this->setStatusCode(500)->respondWithError($errorMessage);
    	}
    }

    /**
     * Update the specified resource in storage.
     * PUT /order/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /order/{id}
     *
     * @param  int $id
     * @return Response
     */
    public
    function destroy($id)
    {
        //
    }


    public function savePaymentOrders(){

        try{

            $email  = Input::get('email');
            $orders = Input::get('orders');

            $paymentOrder = PaymentOrders::where('email', $email)->first();

            if(!$paymentOrder)
            {

                $paymentOrder = new PaymentOrders;
                $paymentOrder->email  = $email;
                $paymentOrder->orders = json_encode($orders);

                $paymentOrder->save(); 
            }
            else
            {
                $paymentOrder = PaymentOrders::find($payuOrder->id);

                $paymentOrder->email  = $email;
                $paymentOrder->orders = json_encode($orders);

                $paymentOrder->save(); 

            }

             $successResponse = [
                'status'       => true,
                'paymentOrder' => $paymentOrder->id
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        }catch (Exception $e){

            return $this->setStatusCode(500)->respondWithError($errorMessage);

        }

    }


    public function buyHistory($userId)
    {

        try{

            $limit = Input::get('limit') ?: 10;

            $orders = Order::with('orderItems.productSku.ProductImages.image',
                                  'orderItems.productSku.product', 'orderItems.orderItemStatus', 'currentOrderStatus', 
                                  'orderStatusHistories','user', 'buyer', 'store')
                            ->where('current_status_id', 1)
                            ->whereExists(function ($query) use ($userId){
                                $query->select(DB::raw(1))
                                    ->from('stores')
                                    ->whereRaw('stores.id = orders.store_id')
                                    ->whereRaw('stores.owner_id = '.$userId);
                            })->paginate($limit);


            if (!$orders) {
                return $this->responseNotFound('Orders Not Found!');
            }

            $fractal = new Manager();

            $buyHistoryResource = new Collection($orders, new BuyHistoryTransformer);

            $buyHistoryResource->setPaginator(new IlluminatePaginatorAdapter($orders));

            $data = $fractal->createData($buyHistoryResource);


            return $data->toJson();
               
        }catch (Exception $e){

           return $this->setStatusCode(500)->respondWithError($errorMessage);
        }

    }

}