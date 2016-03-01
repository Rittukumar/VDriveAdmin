<?php

class EvezownSection extends \Eloquent {
	protected $fillable = ['name'];

	public $timestamps = false;

	public function categories()
	{
		return $this->hasMany('Category');
	}
}