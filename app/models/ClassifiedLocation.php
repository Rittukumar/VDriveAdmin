<?php

class ClassifiedLocation extends \Eloquent {
	protected $fillable = ['id', 'street_address', 'city', 'state', 'country', 'pincode', 'classified_id'];

    protected $table = 'classified_locations';

    public function classified()
    {
        return $this->belongsTo('Classified', 'classified_id', 'id');
    }
}