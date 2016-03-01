<?php

class GroupImage extends \Eloquent {
    protected $fillable = ['id' ,'image_id', 'group_id'];

    protected $table = 'group_image';
}