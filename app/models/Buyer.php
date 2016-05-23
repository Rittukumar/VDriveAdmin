<?php

class Buyer extends \Eloquent {
	
	protected $fillable = ['email', 'phone', 'code', 'status', 'name'];

	// public function billingAddress() {
	// 	return $this->hasOne('BuyerBillingAddress', 'id', 'buyer_id');
	// }

	// public function shippingAddress() {
	// 	return $this->hasOne('BuyerShippingAddress', 'id', 'buyer_id');
	// }

	public function billing_address()
	{
		return $this->hasMany('OrderBillingAddress', 'buyer_id', 'id');
	}

	public function shipping_address()
	{
		return $this->hasMany('OrderShippingAddress', 'buyer_id', 'id');
	}
}