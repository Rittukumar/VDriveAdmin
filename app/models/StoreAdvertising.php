<?php

class StoreAdvertising extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'store_front_to_personal_profile',
        'recco_subscription_id', 'store_price_list', 'store_facebook_link',
        'store_twitter_link', 'store_linkedin_link', 'store_website_link'];
    protected $table = 'store_advertising';
}