<?php

class RequestQuote extends \Eloquent {
	protected $fillable = ['name', 'mobile', 'email', 'city', 'is_contact_email',
		'is_contact_phone', 'other_info', 'other_feedback',
		'comment'];

	protected $table = 'request_quote';
}