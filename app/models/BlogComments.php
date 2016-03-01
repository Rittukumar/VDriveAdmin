<?php

class BlogComments extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'blog_id', 'comment_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'blog_comments';

	public function profile() {
		return $this->belongsTo('UserProfile', 'user_id');
	}

	public function comment() {
		return $this->hasOne('Comment', 'comment_id');
	}
}