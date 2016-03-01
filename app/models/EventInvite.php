<?php

class EventInvite extends \Eloquent {
	protected $fillable = ['id' ,'friend_user_id', 'event_id', 'rsvp'];

	protected $table = 'event_invites';

	public function event()
	{
		return $this->belongsTo('WoiceEvent', 'event_id');
	}

	public function profile() {
		return $this->belongsTo('UserProfile', 'friend_user_id');
	}
}