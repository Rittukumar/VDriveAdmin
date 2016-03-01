<?php

class Order extends \Eloquent {
	protected $fillable = ['transaction_id', 'buyer_id', 'store_id',
		'current_status_id', 'total_amount'];

	public function buyer() {
		return $this->belongsTo('Buyer', 'buyer_id');
	}

	public function store() {
		return $this->hasOne('Store', 'id','store_id');
	}

	// current order status
	public function currentOrderStatus() {
		return $this->hasOne('OrderStatusHistory', 'status_id', 'current_status_id');
	}

	public function orderStatusHistories() {
		return $this->hasMany('OrderStatusHistory', 'order_id', 'id');
	}

	public function orderItems() {
	   return $this->hasMany('OrderItem', 'order_id', 'id');
	}
}