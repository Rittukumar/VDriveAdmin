<?php

class Invite extends \Eloquent {
	protected $fillable = array('code', 'name', 'surname' ,'email', 'referrer_name',
							'referrer_email', 'location', 'is_evezown_member',
							'profession', 'how_hear_evezown','facebook_link',
							'linkedin_link','claimed_at', 'created_at');

	public function dob() {
		return $this->hasOne('DOB');
	}

	public function location(){
		return $this->hasOne('InviteLocation');
	}

	public function user()
    {
        return $this->belongsTo('User','email','email');
    }
}