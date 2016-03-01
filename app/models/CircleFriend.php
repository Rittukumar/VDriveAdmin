<?php

class CircleFriend extends \Eloquent {
	protected $fillable = ['id', 'friend_user_id', 'circle_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'circle_friends';

	public function profile() {
		return $this->belongsTo('UserProfile', 'friend_user_id');
	}

	public function circle() {
		return $this->belongsTo('Circle');
	}
}