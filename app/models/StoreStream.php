<?php

class StoreStream extends \Eloquent {
	protected $fillable = ['id', 'user_id', 'post_id', 'store_id'];

	public $table = 'store_restreams';
}