<?php

class OrderStatusEnum extends \Eloquent {
	protected $fillable = ['id','status'];

	public $timestamps = false;

	protected $table = 'order_status_enum';
}