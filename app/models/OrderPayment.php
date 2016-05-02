<?php

class OrderPayment extends \Eloquent
{
    protected $fillable = ['order_id', 'payment_mode_id', 'check_dd_number', 'check_dd_date', 'status'];

    public function order() {
        return $this->belongsTo('Order', 'order_id');
    }
    public function paymentMode() {
    	return $this->belongsTo('PaymentMode','id', 'payment_mode_id');
    }
}