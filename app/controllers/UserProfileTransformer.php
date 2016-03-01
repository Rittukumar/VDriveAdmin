<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class UserProfileTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(UserProfile $userProfile)
    {
        return [
            'id'    => (int) $userProfile['id'],
            'firstname' => $userProfile->firstname,
            'lastname' => $userProfile->lastname,
            'email' => $userProfile->users['email'],
            'aboutme' => $userProfile->users['about_me'],
            'leftCoverPic' => $userProfile->left_cover_pic,
            'RightCoverPic' => $userProfile->right_cover_pic,
            'BottomCoverPic' => $userProfile->bottom_cover_pic
        ];
    }
}