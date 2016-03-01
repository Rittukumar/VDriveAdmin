<?php

class EventLocation extends \Eloquent {
	protected $fillable = ['event_id', 'location_id'];

	protected $table = 'event_location';

	public function event()
	{
		return $this->belongsTo('WoiceEvent', 'event_id');
	}
}