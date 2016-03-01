<?php

class ForumReply extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'reply'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'forum_replies';

	public function user(){
		return $this->belongsTo('UserProfile', 'user_id');
	}
}