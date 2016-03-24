<?php

class PaymentMode extends \Eloquent {
	protected $fillable = ['id','title'];

	public $timestamps = false;

	protected $table = 'payment_mode';
}