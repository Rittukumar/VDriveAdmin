<?php

class GroupUser extends \Eloquent {
	protected $fillable = ['id', 'group_id', 'user_id', 'status'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'group_user_profile';

	public function profile() {
		return $this->belongsTo('UserProfile', 'user_id');
	}

	public function group() {
		return $this->belongsTo('Group');
	}
}