<?php

class ReccoSubscription extends \Eloquent {
    protected $table = 'recco_subscriptions';

    protected $fillable = ['id', 'name', 'price'];
}