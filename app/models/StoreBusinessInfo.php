<?php

class StoreBusinessInfo extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'pan_number', 'tin_number', 'vat_number',
        'tan_number', 'service_tax_id', 'store_contract_file', 'billing_info_name',
        'billing_info_address','billing_info_contact_number'];
    protected $table = 'store_business_info';
}