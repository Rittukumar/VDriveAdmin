<?php

class ProductImages extends \Eloquent {

    protected $table = 'product_sku_images';
    protected $fillable = ['id', 'product_sku_id', 'product_image_id'];

    public function image()
    {
        return $this->belongsTo('EvezownImage', 'product_image_id', 'id');
    }
}