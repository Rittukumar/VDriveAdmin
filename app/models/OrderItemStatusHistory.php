<?php

class OrderItemStatusHistory extends \Eloquent {
	protected $fillable = ['order_item_id', 'status_id', 'status_comment'];

	protected $table = 'order_item_status_histories';

	public function status() {
		$this->hasOne('OrderStatusEnum','status_id');
	}
}