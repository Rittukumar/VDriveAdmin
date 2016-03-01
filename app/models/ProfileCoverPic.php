<?php

class ProfileCoverPic extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'left_image_id', 'right_image_id', 'bottom_image_id'];

	protected $table = 'profile_cover_pic';
}