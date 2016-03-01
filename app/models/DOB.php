<?php

class DOB extends \Eloquent {
	protected $fillable = ['id', 'day', 'month', 'year'];

	protected $table = "dob";
}