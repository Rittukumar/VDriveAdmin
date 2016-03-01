<?php

class Buyer extends \Eloquent {
	protected $fillable = ['email', 'phone', 'code', 'status'];

	public function billingAddress() {
		return $this->hasOne('BuyerBillingAddress', 'id', 'buyer_id');
	}

	public function shippingAddress() {
		return $this->hasOne('BuyerShippingAddress', 'id', 'buyer_id');
	}
}