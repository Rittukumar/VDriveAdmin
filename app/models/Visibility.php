<?php

class Visibility extends \Eloquent {
	protected $fillable = ['type'];

	protected $table = 'visibility';

	public $timestamps = false;
}