<?php

class PostRewoice extends \Eloquent {
	protected $fillable = ['id', 'post_id', 'rewoicer_id'];

	protected $table = 'post_rewoice';

	public function posts()
	{
		return $this->belongsToMany('Post');
	}
}