<?php

class StoreFrontInfo extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'store_caption', 'store_about_us',
        'target_audience', 'offerings', 'motto', 'vision', 'purpose', 'listing_type_id',
        'store_category_id','store_subcategory_id','store_city','store_contact_email',
        'store_contact_phone1','store_contact_phone2','store_contact_phone3','store_policies',
        'store_sales_exchange_policy','store_mandatory_disclosure_link1','store_mandatory_disclosure_link2',
        'store_mandatory_disclosure_link3'];
    protected $table = 'store_front_info';
}