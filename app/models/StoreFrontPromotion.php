<?php

class StoreFrontPromotion extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'promotion_price', 'promotion_tagline', 'promotion_description'];
    protected $table = 'store_front_promotions';


    public function image()
    {
        return $this->hasOne('StoreFrontPromotionImages', 'store_promotion_id', 'id');
    }
}