<?php

class ProductLine extends \Eloquent {
    protected $fillable = ['id', 'store_id', 'title', 'description','type'];
    protected $table = 'product_line';

    public function products()
    {
        return $this->hasMany('Product', 'product_line_id');
    }

    public function store()
    {
        return $this->belongsTo('Store', 'store_id');
    }
}