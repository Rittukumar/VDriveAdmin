<?php

class Commerce extends \Eloquent
{
    protected $fillable = ['id', 'store_id', 'is_payment_gateway_needed', 'terms_conditions', 'billing_address', 'billing_city', 'billing_state', 'billing_country', 'billing_pincode', 'is_offline_payment','is_cash_delivery','is_cheque_payment','contact_number','vendor_name','additional_info'];
    protected $table = 'store_commerce';
}