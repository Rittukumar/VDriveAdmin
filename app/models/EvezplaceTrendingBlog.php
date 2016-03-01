<?php

class EvezplaceTrendingBlog extends \Eloquent {
	protected $fillable = ['id', 'blog_id', 'is_show_evezplace', 'evezown_section_id', 'priority'];

	public function blog() {
		return $this->belongsTo('Blog', 'blog_id');
	}

	public function evezown_section() {
		return $this->belongsTo('EvezownSection', 'evezown_section_id');
	}
}