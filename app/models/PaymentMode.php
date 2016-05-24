<?php

class PaymentMode extends \Eloquent {
	protected $fillable = ['id','title','description'];

	public $timestamps = false;

	protected $table = 'payment_mode';
}