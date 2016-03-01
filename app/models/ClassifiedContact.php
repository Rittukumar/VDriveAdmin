<?php

class ClassifiedContact extends \Eloquent {
	protected $fillable = ['id', 'phone', 'email', 'name', 'classified_id'];

    protected $table = 'classified_contacts';

    public function classified()
    {
        return $this->belongsTo('Classified', 'classified_id', 'id');
    }
}