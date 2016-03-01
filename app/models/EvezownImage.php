<?php

class EvezownImage extends \Eloquent {
	protected $fillable = ['name', 'description', 'small_image_url', 'medium_image_url', 'large_image_url'];

	public $table = 'images';

	public function postimage(){
		return $this->belongsTo('PostImage')->withPivot('large_image_url', 'name');
	}
}