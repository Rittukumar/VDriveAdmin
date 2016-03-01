<?php

class Interview extends \Eloquent {
	protected $fillable = ['id', 'title', 'description', 'link', 'priority'];

	protected $table = 'interviews';
}