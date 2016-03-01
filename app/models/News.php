<?php

class News extends \Eloquent {
	protected $fillable = ['id', 'title', 'description', 'link', 'priority'];

	protected $table = 'news';
}