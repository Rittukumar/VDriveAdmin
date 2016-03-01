<?php

class BlogImage extends \Eloquent {
    protected $fillable = ['id' ,'image_id', 'blog_id'];

    protected $table = 'blog_image';
}