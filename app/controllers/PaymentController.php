<?php


class PaymentController extends AppController {
  
    public function __construct() {
        // Stripe::setApiKey(Config::get('thirdparty_integration')['stripe']['secret']);
    }
  
    

    /*public function stripePayment()
    {
        
        try{

            $token               = Input::get('token');
            $price               = Input::get('total');  
            $customer_stripe_id  = Input::get('customer_stripe_id');
            $customer_id         = Input::get('customer_id');
            $type                = Input::get('type');
            $orders              = Input::get('orders');

            $stripe = $this->stripeIntegration($token, $price, $customer_stripe_id, $customer_id, $type);

            if(!empty($stripe)){
            
                $stripe_payment_details = [];
                $stripe_payment_details['charge_id']  = isset($stripe->id) ? $stripe->id : '';
                $stripe_payment_details['last_four']  = isset($stripe->source['last4']) ? $stripe->source['last4'] : '';
                $stripe_payment_details['card_type']  = isset($stripe->source['brand']) ? $stripe->source['brand'] : '';

               
                if($this->storeOrder($orders, $stripe_payment_details) == 'success')
                {
                    $mess = ['status' => "OK","message" =>"Payment ok"];
                    return $mess;
                }
                else
                {
                    $mess = ['status' => "ERROR","message" =>"Error submitting payment"];
                    return $mess;
                }

            }else{

                $mess = ['status' => "ERROR","message" =>"Error submitting payment"];
                return $mess;
            }


        }catch (Exception $e){

            return $this->setStatusCode(500)->respondWithError($e);
            
        }
            
    }


    public function stripeIntegration($token, $price, $customer_stripe_id, $customer_id, $type){

        try{

        $cents  = round(bcmul($price, 100));

        if($price != 0)
        {     

            if(!empty($customer_stripe_id))
            {
                
                try {
                    $charge = Stripe_Charge::create(array(
                      "amount"      => $cents, 
                      "currency"    => "usd",
                      "customer"    => $customer_stripe_id
                    ));

                    return $charge;

                } catch(Stripe_CardError $e) {
                    $e_json = $e->getJsonBody();
                    $error  = $e_json['error'];
                    return false;
                }

            }
            else
            {

                if($type == 'user')
                {
                    $user = User::find($customer_id);
                }else{
                    $user = Buyer::find($customer_id);
                }
                
                 
                if(empty($user->stripe_id))
                {
                    try 
                    {
                        $customer = Stripe_Customer::create(array(
                          "card"  => $token,
                          "email" => $user->email
                        ));

                        $charge = Stripe_Charge::create(array(
                          "amount"      => $cents, 
                          "currency"    => "usd",
                          "customer"    => $customer->id,
                          ));

                        
                          $user->stripe_id = $customer->id;
                          $user->last_four = $customer->sources->data[0]->last4;
                          $user->save();

                        
                        return $charge;

                    }catch(Stripe_CardError $e) {
                        $e_json = $e->getJsonBody();
                        $error  = $e_json['error'];
                        return false;
                    }

                }
                else
                {
                    try 
                    {
                        $customer      = Stripe_Customer::retrieve($user->stripe_id);
                        $customer_card = $customer->sources->create(array(
                            "source" => $token)
                        );

                        $charge = Stripe_Charge::create(array(
                          "amount"      => $cents, 
                          "currency"    => "usd",
                          "customer"    => $user->stripe_id,
                          "card"        => $customer_card->id,
                        ));

                        return $charge;
                    } 
                    catch(Stripe_CardError $e) {
                        $e_json = $e->getJsonBody();
                        $error  = $e_json['error'];
                        return false;
                    }
                }
            }

        }

        }catch (Exception $e){

            return $this->setStatusCode(500)->respondWithError($e);
            
        }

    }
*/

    public function payuPayment(){

        try{

            $inputArray = Input::all();
            
            $payuOrder = PaymentOrders::where('email', $inputArray['email'])->pluck('orders');

            $inputArray['orders'] = json_decode($payuOrder, true);

            $inputArray['orders']['paymentMode'] = 5;

            $inputArray['order_success'] = '';

            $status = $inputArray['status'];
            
            $delete = PaymentOrders::where('email', $inputArray['email'])->delete();

            if($status == 'success')
            {

              if($this->storeOrder($inputArray['orders'], '') == 'success')
                {

                    $inputArray['order_success'] = 'success';

                    return View::make('paymentstatus')->with('data',$inputArray);
                }
                else
                {
                    return View::make('paymentstatus')->with('data',$inputArray);
                }

            }else{
               return View::make('paymentstatus')->with('data',$inputArray);
            }

        }catch (Exception $e){

            return View::make('paymentstatus')->with('data',$inputArray);
            

        }

    }



    public function storeOrder($orders, $stripe_payment_details){

       return $browser_loaded = (new OrderController)->saveOrders($orders, $stripe_payment_details); 
    }


    //Store subscription payment
    public function SubscriptionPayment()
    {
        $inputArray = Input::all();
        $status = $inputArray['status'];
        $TransactionId = $inputArray['txnid'];
        $PaymentAmount = $inputArray['amount'];
        $StoreSubscription = $inputArray['productinfo'];
        $StoreName = $inputArray['firstname'];
        $StoreId = $inputArray['zipcode'];
        $UserEmail = $inputArray['email'];
        $UserPhone = $inputArray['phone'];
       
        if($status == 'success')
        {
            try 
            {
                //Update store status(store_status table)
                $storeStatus = StoreStatus::where('store_id', $StoreId)->first();
                

                if($StoreSubscription == 1)
                {
                    $storeStatus->status_id = 2;
                    $storeStatus->save();
                }
                else
                {
                    $storeStatus->status_id = 7;
                    $storeStatus->save();
                }

                //Update store subscription(stores table)
                $Store_Sub = Store::find($StoreId);

                $Store_Sub->store_subscription_id = $StoreSubscription;

                $Store_Sub->save();
                

                // Send an notification email to store admin and editor.

                $user = array(
                    'email' => $UserEmail,
                    'name' => $StoreName
                );

                $data = array(
                    'email' => $UserEmail,
                    'name' => $StoreName,
                    'subscription' => $StoreSubscription,
                    'payment' => $PaymentAmount
                );

                $emails = [$UserEmail, 'editor@evezown.com'];

                Mail::send('emails.storePaymentSuccess', $data, function ($message) use ($user, $emails) {
                    $message->from('editor@evezown.com');
                    $message->to($emails)->subject('Store Activated successfully');
                });

                return View::make('subscriptionStatus')->with('data',$inputArray);

            } catch (Exception $e) {
                return $this->setStatusCode(500)->respondWithError($e);
                //return $e;
            }
        }
        else
        {
           return View::make('subscriptionStatus')->with('data',$inputArray);
        }
    }
  
}

