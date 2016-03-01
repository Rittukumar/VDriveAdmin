<?php

class StoreFrontImages extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'profile_image_id', 'collage_image1_id', 'collage_image2_id', 'collage_image3_id'];
    protected $table = 'store_front_images';
}