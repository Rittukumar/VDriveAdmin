<?php

class StoreFrontPromotionImages extends \Eloquent
{
    protected $fillable = ['id', 'store_promotion_id', 'promotion_image1_id', 'promotion_image2_id', 'promotion_image3_id', 'promotion_image4_id'];
    protected $table = 'store_front_promotion_images';

    public function image1()
    {
        return $this->belongsTo('EvezownImage', 'promotion_image1_id', 'id');
    }
    public function image2()
    {
        return $this->belongsTo('EvezownImage', 'promotion_image2_id', 'id');
    }
    public function image3()
    {
        return $this->belongsTo('EvezownImage', 'promotion_image3_id', 'id');
    }
    public function image4()
    {
        return $this->belongsTo('EvezownImage', 'promotion_image4_id', 'id');
    }

}