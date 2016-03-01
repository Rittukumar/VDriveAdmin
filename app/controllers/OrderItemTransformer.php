<?php

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 30/10/15
 * Time: 2:15 AM
 */
class OrderItemTransformer
{
    public function transform(OrderItem $orderItem)
    {
        return [
            'id'    => (int) $orderItem['id'],
            'product_id' => (int) $orderItem['product_id'],
            'quantity' => (int) $orderItem['quantity'],
            'price' => (float) $orderItem['price'],
            'expected_shipping_date' => (int)$orderItem['expected_shipping_date'],
            'expected_delivery_date' => $orderItem['expected_delivery_date'],
            'order_item_status' => $orderItem['orderItemStatus'],
            'productSku' => [
                'id' => (int) $orderItem->productSku->id,
                'title' => $orderItem->productSku->product['title'],
                'description' => $orderItem->productSku->product['description'],
                'image' => $orderItem->productSku->ProductImages[0]->image,
                'product' => $orderItem->productSku->product
            ]
        ];
    }
}