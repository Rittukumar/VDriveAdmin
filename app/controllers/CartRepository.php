<?php 

class CartRepository
{

	public function saveCart($user_id, $contents)
	{
    $check_user_exists = \CartContents::where('user_id', $user_id)->first();      
                                                  
      if(empty($check_user_exists))
      {
          $cart = new \CartContents();
      }
      else
      {
        $cart = \CartContents::find($check_user_exists->id);
      }

      $cart -> user_id    = $user_id;
      $cart -> contents   = json_encode($contents);

      $cart -> save();
	}


  public function deleteCart($user_id)
  {

    $delete = \CartContents::where('user_id', $user_id)->delete();

  }



}  
