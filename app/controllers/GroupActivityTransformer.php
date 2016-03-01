<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class GroupActivityTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param UserProfile $user
     * @return array
     */
    public function transform(GroupActivity $groupActivity)
    {
        return [
            'id'    => (int) $groupActivity->id,
            'group_id'    => (int) $groupActivity['group_id'],
            'user_id'    => (int) $groupActivity['user_id'],
            'title' => $groupActivity['title'],
            'description' => $groupActivity['description'],
            'group' => $groupActivity->group,
            'user_profile' => $groupActivity->user,
            'images' => $groupActivity->images,
            'links' => $groupActivity->links,
            'comments' => $groupActivity->comments,
            'created_date' => $groupActivity->created_at,
            'updated_date' => $groupActivity->updated_at,
            'avgscale' => $groupActivity->avgscale,
            'scale' => $groupActivity->scale,
            'grades'=> $groupActivity->grades
        ];
    }
}