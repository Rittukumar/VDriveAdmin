<?php

class EventActivityImage extends \Eloquent {
	protected $fillable = ['id', 'event_activity_id', 'image_id'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'event_activity_images';
}