<?php

class StoreProductRfq extends \Eloquent {
	protected $fillable = ['rfq_id', 'product_id', 'required_delivery_date',
			'required_quantity', 'likely_purchase_date', 'delivery_city',
			'delivery_state', 'delivery_country'];

    protected $table = 'store_product_rfq';

	public function product() {
		return $this->hasOne('Product', 'id', 'product_id');
	}
}