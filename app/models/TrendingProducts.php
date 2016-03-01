<?php

class TrendingProducts extends \Eloquent {
    protected $fillable = ['id', 'store_id', 'product_sku_id'];

    protected $table = 'trending_products';

    public function Images()
    {
        return $this->hasMany('ProductImages', 'product_sku_id')->join('images', 'product_sku_images.product_image_id', '=', 'images.id');
    }

    public function Details()
    {
        return $this->belongsTo('Product', 'product_sku_id');
    }
}