<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class BrandTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(Brand $brand)
    {
        return [
            'id'    => (int) $brand['id'],
            'title' => $brand['title'],
            'imageName' => $brand['image_name'],
            'SubCatId' => $brand['sub_cat_id'],
        ];
    }
}