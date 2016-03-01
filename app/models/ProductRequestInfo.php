<?php

class ProductRequestInfo extends \Eloquent {
	protected $fillable = ['rfi_id', 'product_id'];

	protected $table = 'product_request_info';

	public function request_info()
	{
		return $this->hasOne('RequestInfo', 'id', 'rfi_id');
	}

	public function product() {
		return $this->belongsTo('Product', 'product_id', 'id');
	}
}