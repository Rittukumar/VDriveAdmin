<?php

class ClassifiedTag extends \Eloquent {
	protected $fillable = ['tag_id', 'classified_id'];

    protected $table = 'classified_tags';

    public function tag()
    {
        return $this->belongsTo('Tag', 'tag_id', 'id');
    }
}