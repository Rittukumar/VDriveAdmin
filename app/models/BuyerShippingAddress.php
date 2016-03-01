<?php

class BuyerShippingAddress extends \Eloquent {
	protected $fillable = ['buyer_id', 'address_line1', 'address_line2', 'address_line3', 'city', 'state',
		'country', 'pincode'];
}