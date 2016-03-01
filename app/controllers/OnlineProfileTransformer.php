<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class OnlineProfileTransformer extends Fractal\TransformerAbstract
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
            'website' => $user->profile['website_link'],
            'facebook' => $user->profile['facebook_address'],
            'linkedin' => $user->profile['linkedin_address'],
            'twitter' => $user->profile['twitter_link'],
            'pinterest' => $user->profile['pinterest_link'],
            'googlePlus' => $user->profile['google_plus_link'],
            'youtube' => $user->profile['youtube_link'],
            'otherSocial' => $user->profile['other_social_link'],
            'ecommerce' => $user->profile['ecommerce_link'],
        ];
    }
}