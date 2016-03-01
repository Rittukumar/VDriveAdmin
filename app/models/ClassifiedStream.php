<?php

class ClassifiedStream extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'post_id', 'classified_id'];

	public $table = 'classified_restreams';
}