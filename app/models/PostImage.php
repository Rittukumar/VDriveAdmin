<?php

class PostImage extends \Eloquent {
	protected $fillable = ['image_id', 'post_id'];

	protected $table = 'post_images';

	public function posts()
	{
		return $this->belongsToMany('Post');
	}
}