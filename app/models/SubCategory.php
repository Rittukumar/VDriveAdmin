<?php

class SubCategory extends \Eloquent {
	protected $fillable = ['subcategory_name'];

	public $timestamps = false;

	public function category()
	{
		return $this->belongsTo('Category');
	}
}