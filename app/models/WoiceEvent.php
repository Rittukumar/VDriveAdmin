<?php

class WoiceEvent extends \Eloquent {
	protected $fillable = ['id', 'title', 'description', 'start_date', 'end_date', 'start_time', 'end_time', 'owner_id','visibility_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';

	public function attendees() {
		return $this->hasMany('EventInvite', 'event_id')->where('rsvp', 'yes');;
	}

	public function event_image() {
		return $this->hasOne('EventImage', 'event_id')->join('images', 'event_image.image_id', '=', 'images.id');
	}

	public function location(){
		return $this->hasOne('EventLocation', 'event_id')->join('locations', 'event_location.location_id', '=', 'locations.id');
	}

	public function owner() {
		return $this->belongsTo('UserProfile', 'owner_id');
	}

	public function activities() {
		return $this->hasMany('EventActivity');
	}

    public function grades()
    {
        return $this->hasMany('EventGrade');
    }
}