<?php

class Video extends \Eloquent {
	protected $fillable = ['id', 'title', 'link', 'priority'];

	protected $table = 'videos';
}