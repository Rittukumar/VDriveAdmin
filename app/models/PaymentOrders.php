<?php

class PaymentOrders extends \Eloquent {
	protected $fillable = ['email', 'orders'];

	protected $table = 'payment_orders';
}