<?php

class ClassifiedImage extends \Eloquent {
	protected $fillable = ['classified_id', 'title_image_name', 'body_image1_name', 'body_image2_name',
                            'body_image3_name', 'body_image4_name'];

    protected $table = 'classified_images';

    public function image() {
        return $this->hasOne('Image', 'image_id');
    }
}