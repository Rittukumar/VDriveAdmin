<?php

class EventImage extends \Eloquent {
	protected $fillable = ['id' ,'image_id', 'event_id'];

	protected $table = 'event_image';
}