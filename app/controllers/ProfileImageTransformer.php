<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class ProfileImageTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(UserProfileImage $profileImage)
    {
        return [
            'id'    => (int) $profileImage['id'],
            'user_id'    => (int) $profileImage['user_id'],
            'image_id'    => (int) $profileImage['image_id'],
            'profile_image_name'    => $profileImage->image['large_image_url'],
            'created_at'    => $profileImage['created_at'],
        ];
    }
}