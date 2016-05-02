<?php

class StoreSubscriptionOffer extends \Eloquent {
	protected $fillable = ['store_id','amount','subscription_id'];

    protected $table = 'store_subscription_offer';
}