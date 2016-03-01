<?php

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 30/10/15
 * Time: 1:47 AM
 */

use League\Fractal;

class OrderTransformer extends Fractal\TransformerAbstract
{
    protected $defaultIncludes = [
        'order_items'
    ];

    public function transform(Order $order)
    {
        return [
            'id' => (int)$order['id'],
            'transaction_id' => $order['transaction_id'],
            'description' => $order['description'],
            'link' => $order['link'],
            'order_status' => $order['currentOrderStatus'],
            'order_status_history' => $order['orderStatusHistories'],
            'priority' => (int)$order['priority'],
            'create_date' => $order['created_at'],
            'buyer' => [
                'id' => (int) $order->buyer->id,
                'email' => $order->buyer->email,
                'phone' => $order->buyer->phone,
                'code' => $order->buyer->code
            ]
        ];
    }

    public function includeOrderItems(Order $order)
    {
        return $this->collection($order->order_items, new OrderItemTransformer());
    }
}