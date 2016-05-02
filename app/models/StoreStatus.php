<?php

class StoreStatus extends \Eloquent {
	protected $fillable = ['store_id', 'status_id'];

    protected $table = 'store_status';
}