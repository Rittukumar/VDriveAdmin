<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class GroupTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param UserProfile $user
     * @return array
     */
    public function transform(Group $group)
    {
        return [
            'id' => (int) $group->id,
            'owner_id' => (int) $group->owner_id,
            'group_owner' => $group->owner,
            'title' => $group->title,
            'description' => $group->description,
            'created_date' => $group->created_at,
            'visibility_id'=>$group->visibility_id,
            'updated_date' => $group->updated_at,
            'members' => $group->members,
            'group_image' => $group->group_image
        ];
    }
}