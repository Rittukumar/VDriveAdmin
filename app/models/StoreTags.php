<?php

class StoreTags extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'tag_id','created_at','updated_at'];
    protected $table = 'store_tags';
}