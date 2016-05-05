<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class ForumTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param UserProfile $user
     * @return array
     */
    public function transform(Forum $forum)
    {
        return [
            'id'    => (int) $forum->id,
            'owner_id'    => (int) $forum->owner_id,
            'topic_title' => $forum['title'],
            'topic_description' => $forum['description'],
            'replies' => $forum->replies,
            'visibility_id' => $forum['visibility_id'],
            'subcategory' => $forum->subcategory,
            'created_by' => $forum->created_by,
            'created_date' => $forum->created_at,
            'updated_date' => $forum->updated_at,
            'scale' => $forum->scale,
            'trending' => $forum->trending
        ];
    }
}