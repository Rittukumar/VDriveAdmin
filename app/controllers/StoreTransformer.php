<?php
use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 02/11/15
 * Time: 5:40 PM
 */
class StoreTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(Store $store)
    {
        return [
            'id'    => $store['id'],
            'title'    => $store['title'],
            'description'    => $store['description'],
            'business_info' => $store->business_info,
            'city' => $store->city,
            'web_address'    => $store['web_address'],
            'zip'    => $store['zip'],
            'owner' => $store->owner,
            'collage_image1' => $store->collage_image1,
            'collage_image2' => $store->collage_image2,
            'collage_image3' => $store->collage_image3,
            'profile_images' => $store->profile_images,
            'profile' => $store->profile,
            'owner_id' => $store->owner_id,
            'store_front_info' => $store->store_front_info,
            'is_approved' => $store->is_approved,
        ];
    }
}