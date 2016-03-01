<?php

class StoreStatus extends \Eloquent {
	protected $fillable = ['store_id', 'status'];

    protected $table = 'store_status';
}