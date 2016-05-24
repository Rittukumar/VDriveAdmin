<?php

class PaymentDetails extends \Eloquent 
{
    protected $table = 'payment_details';


    protected $guarded = ['id'];

   

    /*
	|--------------------------------------------------------------------------
	| Relationships
	|--------------------------------------------------------------------------
	*/
	/**
     * @return mixed
     */
    public function order()
    {
        return $this->belongsTo('Order', 'order_id');
    }
    
}
