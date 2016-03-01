<?php

class EvezplaceTrendingForum extends \Eloquent {
	protected $fillable = ['id', 'forum_id', 'is_show_evezplace', 'evezown_section_id', 'priority'];

	public function forum() {
		return $this->belongsTo('Forum', 'forum_id');
	}

	public function evezown_section() {
		return $this->belongsTo('EvezownSection', 'evezown_section_id');
	}
}