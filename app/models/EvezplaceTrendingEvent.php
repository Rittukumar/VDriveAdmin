<?php

class EvezplaceTrendingEvent extends \Eloquent {
	protected $fillable = ['id', 'event_id', 'is_show_evezplace', 'evezown_section_id', 'priority'];

	public function event() {
		return $this->belongsTo('Event', 'event_id');
	}

	public function evezown_section() {
		return $this->belongsTo('EvezownSection', 'evezown_section_id');
	}
}