<?php

class ProductStock extends \Eloquent {
    protected $fillable = ['id', 'product_sku_id', 'quantity'];
    protected $table = 'product_sku_stock';
}