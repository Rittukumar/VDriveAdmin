<?php

class Location extends \Eloquent {
	protected $fillable = ['street_address', 'street_address2', 'locality', 'city',
                            'state', 'state_code', 'country', 'country_code', 'zip',
                            'latitude', 'longitude'];
}