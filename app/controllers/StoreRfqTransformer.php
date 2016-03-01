<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 05/01/16
 * Time: 5:38 PM
 */
class StoreRfqTransformer extends Fractal\TransformerAbstract
{
    public function transform(StoreRfq $storeRfq)
    {
        return [
            'id' => (int)$storeRfq['id'],
            'name' => $storeRfq->rfq->name,
            'mobile' => $storeRfq->rfq->mobile,
            'email' => $storeRfq->rfq->email,
            'city' => $storeRfq->rfq->city,
            'is_contact_email' => (bool) $storeRfq->rfq->is_contact_email,
            'is_contact_phone' => (bool) $storeRfq->rfq->is_contact_phone,
            'other_info' => $storeRfq->rfq->other_info,
            'other_feedback' => $storeRfq->rfq->other_feedback,
            'comment' => $storeRfq->rfq->comment,
            'products' => $storeRfq->store_products,
            'created_date' => date('F d, Y', strtotime($storeRfq->rfq->created_at))
        ];
    }
}