<?php

class PostType extends \Eloquent {
	protected $fillable = ['type'];

	protected $table = 'post_type';

    public $timestamps = false;

}