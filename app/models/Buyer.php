<?php
use Laravel\Cashier\BillableTrait;
use Laravel\Cashier\BillableInterface;
class Buyer extends \Eloquent implements BillableInterface{
	use BillableTrait;
	protected $fillable = ['email', 'phone', 'code', 'status'];

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