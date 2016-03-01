<?php

class StoreComment extends \Eloquent {
	protected $fillable = ['comment_id', 'store_id', 'user_id'];

	public $table = 'store_front_comments';

	public function store() {
		return $this->belongsToMany('Store');
	}

	public function comment()
	{
		return $this->hasOne('Comment', 'id','comment_id');
	}

	public function commenter()
	{
		return $this->hasOne('User', 'id', 'user_id');
	}
}