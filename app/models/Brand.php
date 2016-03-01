<?php

class Brand extends \Eloquent {
	protected $fillable = ['id', 'title', 'sub_cat_id','image_name'];

	protected $table = 'brand';

	public function post()
	{
		return $this->belongsTo('Post');
	}
}