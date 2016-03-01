<?php

class OrderItemBillingAddress extends \Eloquent {
	protected $fillable = ['order_item_id', 'address_line1', 'address_line2', 'address_line3', 'city', 'state',
		'country', 'pincode'];

	protected $table = 'order_item_billing_addresses';
}