<?php

class OrderShippingAddress extends \Eloquent {
	protected $fillable = ['order_id', 'address_line1', 'address_line2', 'address_line3', 'city', 'state',
		'country', 'pincode'];

	protected $table = 'order_shipping_addresses';
}