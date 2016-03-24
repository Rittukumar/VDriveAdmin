<?php

class Friend extends \Eloquent {
	protected $fillable = ['friend_user_id', 'user_id', 'status'];

	protected $table = 'friends';

	public function profile(){
		return $this->belongsTo('UserProfile', 'friend_user_id');
	}

	public function user(){
		return $this->belongsTo('User', 'friend_user_id', 'id');
	}
}