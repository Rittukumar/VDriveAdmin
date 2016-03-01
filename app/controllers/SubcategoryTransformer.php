<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class SubcategoryTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(SubCategory $subCategory)
    {
        return [
            'id'    => (int) $subCategory['id'],
            'subcategory_name'    => $subCategory['subcategory_name'],
            'category_name'    => $subCategory->category['category_name'],
            'category_id'    => $subCategory->category['id'],
        ];
    }
}