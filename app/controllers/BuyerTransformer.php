<?php
use League\Fractal;
/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 29/10/15
 * Time: 6:20 PM
 */
class BuyerTransformer extends Fractal\TransformerAbstract
{
    public function transform(Buyer $buyer)
    {
        return [
            'id'    => (int) $buyer['id'],
            'email' => $buyer['email'],
            'phone' => $buyer['phone'],
            'code' => $buyer['code'],
            'billing_address' => [
                'id' => $buyer->billingAddress['id'],
                'address_line1' => $buyer->billingAddress['address_line1'],
                'address_line2' => $buyer->billingAddress['address_line2'],
                'address_line3' => $buyer->billingAddress['address_line3'],
                'city' => $buyer->billingAddress['city'],
                'state' => $buyer->billingAddress['state'],
                'country' => $buyer->billingAddress['country'],
                'pincode' => $buyer->billingAddress['pincode'],
            ],
            'shipping_address' => [
                'id' => $buyer->shippingAddress['id'],
                'address_line1' => $buyer->shippingAddress['address_line1'],
                'address_line2' => $buyer->shippingAddress['address_line2'],
                'address_line3' => $buyer->shippingAddress['address_line3'],
                'city' => $buyer->shippingAddress['city'],
                'state' => $buyer->shippingAddress['state'],
                'country' => $buyer->shippingAddress['country'],
                'pincode' => $buyer->shippingAddress['pincode'],
            ]
        ];
    }
}