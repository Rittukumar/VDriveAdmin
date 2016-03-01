<?php

class GroupActivityComment extends \Eloquent {
	protected $fillable = ['id', 'group_activity_id', 'user_id', 'comment_id'];

	public function profile() {
		return $this->belongsTo('UserProfile', 'user_id');
	}

	public function comment() {
		return $this->hasOne('Comment', 'comment_id');
	}

	public function group_activity() {
		return $this->belongsTo('GroupActivity', 'group_activity_id');
	}
}