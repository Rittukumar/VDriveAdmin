<?php

class PostComment extends \Eloquent {
	protected $fillable = ['comment_id', 'owner_id', 'post_id'];

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

	public function comment() {
		return $this->belongsTo('Comment', 'comment_id', 'id');
	}

	public function user(){
		return $this->belongsTo('UserProfile', 'owner_id', 'user_id');
	}
}