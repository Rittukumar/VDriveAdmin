<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class FriendTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param UserProfile $user
     * @return array
     */
    public function transform(Friend $friends)
    {
        return [
            'id'    => (int) $friends['id'],
            'user_id' => (int) $friends['user_id'],
            'friend_user_id' => (int) $friends['friend_user_id'],
            'status' => $friends['status'],
            'profile' => $friends['profile'],
            'user' => $friends['user']
        ];
    }
}