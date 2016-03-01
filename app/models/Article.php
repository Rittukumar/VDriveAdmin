<?php

class Article extends \Eloquent {
	protected $fillable = ['id', 'title', 'description', 'link', 'priority'];

	protected $table = 'articles';
}