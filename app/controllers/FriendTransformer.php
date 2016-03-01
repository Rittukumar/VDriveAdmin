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
    public function transform(Friend $user)
    {
        return [
            'id'    => (int) $user->id,
            'user_id'    => (int) $user->profile['id'],
            'firstname' => $user->profile['firstname'],
            'lastname' => $user->profile['lastname'],
            'active'    => (int) $user->active
        ];
    }
}