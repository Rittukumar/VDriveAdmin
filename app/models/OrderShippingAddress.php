<?php

class OrderShippingAddress extends \Eloquent {
	protected $fillable = ['user_id', 'buyer_id', 'address_line1', 'address_line2', 'address_line3', 'city', 'state',
		'country', 'pincode'];

	protected $table = 'shipping_address';
}