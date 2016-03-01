<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class CircleTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param UserProfile $user
     * @return array
     */
    public function transform(Circle $circle)
    {
        return [
            'id' => (int) $circle->id,
            'user_id' => (int) $circle->user_id,
            'title' => $circle->title,
            'visibility_id' => $circle->visibility_id,
            'description' => $circle->description,
            'created_date' => $circle->created_at,
            'updated_date' => $circle->updated_at,
            'friends' => $circle->friends
        ];
    }
}