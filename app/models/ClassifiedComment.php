<?php

class ClassifiedComment extends \Eloquent {
	protected $fillable = ['comment_id', 'classified_id', 'user_id'];

	public $table = 'classified_comments';

	public function classified() {
		return $this->belongsToMany('Classified');
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