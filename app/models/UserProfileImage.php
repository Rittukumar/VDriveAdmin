<?php

class UserProfileImage extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'image_id'];
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_profile_image';


	public function image(){

		return $this->belongsTo('EvezownImage');
	}
}