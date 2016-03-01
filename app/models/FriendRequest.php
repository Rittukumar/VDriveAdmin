<?php

class FriendRequest extends \Eloquent {
	protected $fillable = ['friend_user_id', 'user_id', 'status'];

	protected $table = 'friend_request';

	public function requester(){
		return $this->belongsTo('UserProfile', 'user_id');
	}
}