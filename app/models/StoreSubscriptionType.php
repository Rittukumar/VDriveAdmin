<?php

class StoreSubscriptionType extends \Eloquent
{
    protected $table = 'store_subscription_type';

    protected $fillable = ['id', 'name', 'price'];
}