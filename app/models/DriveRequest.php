<?php

class DriveRequest extends \Eloquent {
	protected $table = 'drive_request';
	protected $fillable = ['driver_id', 'customer_name', 'customer_phone', 'email_id', 'pickup_point', 'drop_point','status','device_id'];
}