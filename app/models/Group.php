<?php

class Group extends \Eloquent {
	protected $fillable = array('id', 'title', 'description', 'owner_id','visibility_id');

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'groups';

	public function owner(){
		return $this->belongsTo('UserProfile', 'owner_id');
	}

    public function group_image() {
        return $this->hasOne('GroupImage', 'group_id')->join('images', 'group_image.image_id', '=', 'images.id');
    }

	public function members() {
		return $this->hasMany('GroupUser', 'group_id')->where('status', 'approved');
	}
}