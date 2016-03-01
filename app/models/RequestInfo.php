<?php

class RequestInfo extends \Eloquent
{
    protected $fillable = ['name', 'mobile', 'email', 'city', 'is_contact_email',
        'is_contact_phone', 'required_delivery_date', 'required_quantity', 'likely_purchase_date',
        'delivery_city', 'delivery_state', 'delivery_country', 'other_info', 'other_feedback',
        'comment'];

    protected $table = 'request_info';
}