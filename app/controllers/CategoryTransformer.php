<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class CategoryTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id'    => (int) $category['id'],
            'category_name'    => $category['category_name'],
            'section_name'    => $category->section['name'],
            'section_id'    => $category->section['id'],
            'subcategories' => $category->subcategories
        ];
    }
}