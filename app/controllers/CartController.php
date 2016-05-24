<?php 


class CartController extends AppController {
   
   public function __construct()
   {
      //parent::__construct();
      $this->cartRepository = App::make('CartRepository');
   }


   public function addProductToCart()
   {  
      try{
            
            $cart_data     = Input::all();
            $cart_contents = $cart_data['cart_contents'];
            $user_id       = $cart_data['user_id'];

            return $this->cartRepository->saveCart($user_id, $cart_contents);


       } catch(Exception $e) {

          $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);

       }  	
	   	
    }


    public function checkCartProducts()
    {

      try{
            
            $cart_data     = Input::all();
            $cart_contents = $cart_data['cart_contents'];
            $user_id       = $cart_data['user_id'];

            $oldCart = UIHelper::checkCart($user_id, $cart_contents);

            if(empty($oldCart))
            {
              $this->cartRepository->saveCart($user_id, $cart_contents);
            }

            return $oldCart;


       } catch(Exception $e) {

          $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);

       }    

    }


    public function getCartProducts()
    {

   	  try{
            
            $cart_data     = Input::all();
            $user_id       = $cart_data['user_id'];

            $cartProducts = UIHelper::getCart($user_id); 

            return $cartProducts;
            
       } catch(Exception $e) {

          $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);

       } 

    }


    public function deleteCart()
    {

      try{
            
            $cart_data     = Input::all();
            $user_id       = $cart_data['user_id'];

            return $this->cartRepository->deleteCart($user_id);
            
       } catch(Exception $e) {

          $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);

       } 

    }


}