<?php

class EvezplaceRecommendation extends \Eloquent {
	protected $fillable = ['id', 'title', 'description', 'link', 'image_id', 'evezown_section_id', 'priority'];

	public function image() {
		return $this->hasOne('EvezownImage', 'id', 'image_id');
	}

	public function evezown_section() {
		return $this->belongsTo('EvezownSection', 'evezown_section_id');
	}
}