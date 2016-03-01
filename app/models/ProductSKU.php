<?php

class ProductSKU extends \Eloquent {
    protected $fillable = ['id', 'product_id', 'price', 'discount','tax', 'shipping_charge'
                            ,'size','color','weight','volume','is_trending'];

    protected $table = 'product_sku';

    public function ProductImages() {
        return $this->hasMany('ProductImages', 'product_sku_id');
    }
    public function ProductStock()
    {
        return $this->hasOne('ProductStock', 'product_sku_id');
    }

    public function product()
    {
        return $this->belongsTo('Product', 'product_id');
    }
}