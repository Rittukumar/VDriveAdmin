<?php

class EventActivity extends \Eloquent {
	protected $fillable = ['id', 'event_id', 'user_id', 'comment'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event_activities';

	public function event(){
		return $this->belongsTo('WoiceEvent', 'event_id');
	}

	public function profile() {
		return $this->belongsTo('UserProfile', 'user_id');
	}

	public function images() {
		return $this->hasMany('EventActivityImage')->join('images', 'event_activity_images.image_id', '=', 'images.id');;
	}
}