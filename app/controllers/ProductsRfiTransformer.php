<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 05/01/16
 * Time: 1:14 PM
 */
class ProductsRfiTransformer extends Fractal\TransformerAbstract
{
    public function transform(ProductRequestInfo $productRfi)
    {
        return [
            'id' => (int)$productRfi['id'],
            'name' => $productRfi->request_info->name,
            'mobile' => $productRfi->request_info->mobile,
            'email' => $productRfi->request_info->email,
            'city' => $productRfi->request_info->city,
            'is_contact_email' => (bool) $productRfi->request_info->is_contact_email,
            'is_contact_phone' => (bool) $productRfi->request_info->is_contact_phone,
            'required_delivery_date' => $productRfi->request_info->required_delivery_date,
            'required_quantity' => $productRfi->request_info->required_quantity,
            'likely_purchase_date' => $productRfi->request_info->likely_purchase_date,
            'delivery_city' => $productRfi->request_info->delivery_city,
            'other_info' => $productRfi->request_info->other_info,
            'other_feedback' => $productRfi->request_info->other_feedback,
            'comment' => $productRfi->request_info->comment,
            'product' => $productRfi->product,
            'created_date' => date('F d, Y', strtotime($productRfi->request_info->created_at))
        ];
    }
}