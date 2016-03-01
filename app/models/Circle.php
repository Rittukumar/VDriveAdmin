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
		return $this->hasMany('CircleFriend', 'circle_id');
	}
}