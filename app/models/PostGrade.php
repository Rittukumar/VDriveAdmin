<?php

class PostGrade extends \Eloquent {
	protected $fillable = ['grade_id', 'owner_id', 'post_id'];

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

	public function grade() {
		return $this->belongsTo('Grade', 'grade_id', 'id');
	}

	public function user(){
		return $this->belongsTo('UserProfile', 'owner_id', 'user_id');
	}
}