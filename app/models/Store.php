<?php

class Store extends \Eloquent {
	protected $fillable = ['id', 'title', 'description', 'web_address', 'email_address', 'street_address', 'city', 'state', 'country', 'zip','license_info','own_a_physical_store','owner_id'];

    public function profile()
    {
        return $this->belongsTo('UserProfile', 'owner_id','user_id');
    }
    public function profile_images()
    {
        return $this->hasOne('StoreFrontImages', 'store_id')->join('images', 'store_front_images.profile_image_id', '=', 'images.id');
    }
    public function collage_image1()
    {
        return $this->hasOne('StoreFrontImages', 'store_id')->join('images', 'store_front_images.collage_image1_id', '=', 'images.id');
    }
    public function collage_image2()
    {
        return $this->hasOne('StoreFrontImages', 'store_id')->join('images', 'store_front_images.collage_image2_id', '=', 'images.id');
    }
    public function collage_image3()
    {
        return $this->hasOne('StoreFrontImages', 'store_id')->join('images', 'store_front_images.collage_image3_id', '=', 'images.id');
    }

    public function owner() {
        return $this->hasMany('Owner', 'store_id');
    }

    public function BusinessInfo() {
        return $this->belongsTo('StoreBusinessInfo', 'id','store_id');
    }

    public function Tags() {
        return $this->hasMany('StoreTags','store_id')->join('tags', 'store_tags.tag_id', '=', 'tags.id');
    }

    public function TrendingProducts() {
        return $this->hasMany('TrendingProducts','store_id')->join('product_sku', 'trending_products.product_sku_id', '=', 'product_sku.id');
    }

    public function StoreFrontInfo()
    {
        return $this->belongsTo('StoreFrontInfo', 'id','store_id');
    }

    public function StoreCommerce()
    {
        return $this->belongsTo('Commerce', 'id','store_id');
    }

    public function StoreFrontPromotion()
    {
        return $this->belongsTo('StoreFrontPromotion', 'id','store_id');
    }

    public function StoreAdvertising()
    {
        return $this->belongsTo('StoreAdvertising', 'id','store_id');
    }

    public function StoreStatus()
    {
        return $this->belongsTo('StoreStatus', 'id','store_id');
    }

    public function comments()
    {
        return $this->hasMany('StoreComment', 'store_id');
    }

    public function grades()
    {
        return $this->hasMany('StoreGrade', 'store_id');
    }

    public function scopeAvgGrade() {

    }
}