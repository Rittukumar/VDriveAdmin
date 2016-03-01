<?php

class OrderItem extends \Eloquent
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'expected_shipping_date',
        'expected_delivery_date'];

    public function order() {
        return $this->belongsTo('Order', 'order_id');
    }

    public function productSku() {
       return $this->hasOne('ProductSKU', 'id', 'product_id');
    }

    public function orderItemStatus() {
        return $this->hasMany('OrderItemStatusHistory', 'order_item_id');
    }

    public function shippingAddress() {
        return $this->hasOne('OrderItemShippingAddress', 'order_item_id');
    }

    public function billingAddress() {
        return $this->hasOne('OrderItemBillingAddress', 'order_item_id');
    }
}