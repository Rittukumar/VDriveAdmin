<?php

class Circle extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'title', 'description','visibility_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'circles';

	public function friends() {
		return $this->hasMany('CircleFriend', 'circle_id')
		            ->join('users', function ($join) {
		              $join->on('users.id', '=', 'circle_friends.friend_user_id');
                    })
                    ->where('users.blocked', 0)
                    ->where('users.deleted', 0);
	}
}