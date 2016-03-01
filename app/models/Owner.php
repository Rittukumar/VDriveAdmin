<?php

class Owner extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'owner_name'];
    protected $table = 'store_owners';
}