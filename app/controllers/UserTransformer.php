<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class UserTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'    => (int) $user['id'],
            'api_key' => $user['api_key'],
            'user_id' => $user->profile['user_id'],
            'firstname' => $user->profile['firstname'],
            'lastname' => $user->profile['lastname'],
            'email' => $user['email'],
            'aboutme' => $user->profile['about_me'],
            'active'    => (int) $user->profile['active'],
            'role' => $user->roles[0]['name'],
            'role_id' => $user->roles[0]['id'],
            'leftCoverPic' => $user->profile['left_cover_pic'],
            'RightCoverPic' => $user->profile['right_cover_pic'],
            'BottomCoverPic' => $user->profile['bottom_cover_pic'],
            'profession' => $user->profile['profession'],
            'designation' => $user->profile['designation1'],
            'organization' => $user->profile['name_organization1'],
            'city' => $user->profile['city'],
            'state' => $user->profile['state'],
            'country' => $user->profile['country'],
            'blocked' => $user['blocked'],
            'deleted' => $user['deleted'],
            'token' => $user['token']
        ];
    }
}