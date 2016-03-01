<?php

class Category extends \Eloquent {
	protected $fillable = ['category_name'];

	public $timestamps = false;

	public function subcategories()
	{
		return $this->hasMany('SubCategory');
	}

	public function section()
	{
		return $this->belongsTo('EvezownSection');
	}
}