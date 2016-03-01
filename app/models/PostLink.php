<?php

class PostLink extends \Eloquent {
	protected $fillable = ['link_id', 'post_id'];

	protected $table = 'post_links';

	public function posts()
	{
		return $this->belongsToMany('Post');
	}
}