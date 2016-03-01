<?php

class OrderStatusHistory extends \Eloquent {
	protected $fillable = ['order_id', 'status_id'];

	protected $table = 'order_status_histories';

	public function order() {
		$this->belongsTo('Order', 'order_id');
	}

	public function status() {
		$this->hasOne('OrderStatusEnum','status_id');
	}
}