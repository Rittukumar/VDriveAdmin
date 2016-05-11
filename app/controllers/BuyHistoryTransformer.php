<?php
use League\Fractal;

class BuyHistoryTransformer extends Fractal\TransformerAbstract
{
    
    public function transform(Order $orders)
    {
        return [
            'id'    => (int) $orders['id'],
            'transaction_id' => $orders['transaction_id'],
            'buyer_id' => $orders['buyer_id'],
            'store_id' => $orders['store_id'],
            'current_status_id' => $orders['current_status_id'],
            'total_amount' => $orders['total_amount'],
            'user_id' => $orders['user_id'],
            'billing_id' => $orders['billing_id'],
            'shipping_id' => $orders['shipping_id'],
            'created_at'  => $orders['created_at'],
            'orderItems' => $orders['orderItems'],
            'currentOrderStatus' => $orders['currentOrderStatus'],
            'orderStatusHistories' => $orders['orderStatusHistories'],
            'user' => $orders['user'],
            'buyer' => $orders['buyer'],
            'store' => $orders['store']
        ];
    }
}