<?php

use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 31/12/15
 * Time: 12:02 AM
 */
class ClassifiedCommentTransformer extends Fractal\TransformerAbstract
{
    /**
     * @param ClassifiedComment $classifiedComment
     * @return array
     * @internal param User $user
     */
    public function transform(ClassifiedComment $classifiedComment)
    {
        return [
            'id'    => (int) $classifiedComment['id'],
            'comment_id' => (int) $classifiedComment->comment->id,
            'comment' => $classifiedComment->comment->comment,
            'commenter_id' => $classifiedComment->commenter->id,
            'commenter_name' => $classifiedComment->commenter->profile->firstname . ', ' .
                $classifiedComment->commenter->profile->lastname,
            'commenter_image' => $classifiedComment->commenter->profile->profile_image->large_image_url
        ];
    }
}