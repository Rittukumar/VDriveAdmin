<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 04/01/16
 * Time: 11:11 AM
 */
class ClassifiedsRfiTransformer extends Fractal\TransformerAbstract
{
    public function transform(ClassifiedRequestInfo $classifiedRfi)
    {
        return [
            'id' => (int)$classifiedRfi['id'],
            'name' => $classifiedRfi->request_info->name,
            'mobile' => $classifiedRfi->request_info->mobile,
            'email' => $classifiedRfi->request_info->email,
            'city' => $classifiedRfi->request_info->city,
            'is_contact_email' => (bool) $classifiedRfi->request_info->is_contact_email,
            'is_contact_phone' => (bool) $classifiedRfi->request_info->is_contact_phone,
            'other_info' => $classifiedRfi->request_info->other_info,
            'other_feedback' => $classifiedRfi->request_info->other_feedback,
            'comment' => $classifiedRfi->request_info->comment,
            'created_date' => date('F d, Y', strtotime($classifiedRfi->request_info->created_at))
        ];
    }
}