<?php

class PostLocation extends \Eloquent {
	protected $fillable = ['post_id', 'location_id'];

    protected $table = 'post_location';

    public function posts()
    {
        return $this->belongsToMany('Post');
    }
}