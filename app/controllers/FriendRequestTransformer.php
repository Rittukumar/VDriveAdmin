<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class FriendRequestTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param UserProfile $user
     * @return array
     */
    public function transform(FriendRequest $friendRequest)
    {
        return [
            'id'    => (int) $friendRequest['id'],
            'requester_user_id' => (int) $friendRequest['user_id'],
            'requester_firstname' => $friendRequest->requester['firstname'],
            'requester_lastname' => $friendRequest->requester['lastname'],
            'request_status' => (int) $friendRequest->status,
            'request_date' => $friendRequest->created_at,
            'requester' => $friendRequest->requester
        ];
    }
}