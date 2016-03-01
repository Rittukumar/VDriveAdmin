<?php

class Product extends \Eloquent {
	protected $fillable = ['id', 'product_line_id', 'title', 'description','delivery_condition', 'shipment_condition'];

    public function ProductSKU() {
        return $this->hasMany('ProductSKU', 'product_id');
    }

    public function ProductLine() {
        return $this->belongsTo('ProductLine', 'product_line_id');
    }
}