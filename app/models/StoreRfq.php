<?php

class StoreRfq extends \Eloquent {
	protected $fillable = ['store_id', 'rfq_id'];

	protected $table = 'store_rfq';

	public function store() {
		return $this->belongsTo('Store', 'store_id');
	}

	public function rfq() {
		return $this->hasOne('RequestQuote', 'id','rfq_id');
	}

	public function store_products() {
		return $this->hasMany('StoreProductRfq', 'rfq_id');
	}
}