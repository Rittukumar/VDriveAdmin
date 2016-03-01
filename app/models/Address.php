<?php

class Address extends \Eloquent {
	protected $fillable = ['address_line1', 'address_line2', 'address_line3', 'city', 'state',
							'country', 'pincode'];
}