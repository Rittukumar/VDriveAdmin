<?php

class GroupActivity extends \Eloquent {
	protected $fillable = ['id', 'user_id' ,'group_id', 'title', 'description'];

	protected $table = 'group_activities';

	public function group() {
		return $this->belongsTo('Group', 'group_id');
	}

	public function images(){
		return $this->hasMany('GroupActivityImage')->join('images', 'group_activity_images.image_id', '=', 'images.id');
	}

	public function links() {
		return $this->hasMany('GroupActivityLink')->join('links', 'group_activity_links.link_id', '=', 'links.id');
	}

	public function user(){
		return $this->belongsTo('UserProfile', 'user_id');
	}

	public function comments() {
		return $this->hasMany('GroupActivityComment')->join('comments', 'group_activity_comments.comment_id', '=', 'comments.id');
	}

    public function grades(){
        return $this->hasMany('GroupActivityGrade');
    }
}