<?php

class InviteLocation extends \Eloquent {
    protected $fillable = ['invite_id', 'location_id'];

    protected $table = 'invite_location';

    public function invite()
    {
        return $this->belongsTo('Invite');
    }
}