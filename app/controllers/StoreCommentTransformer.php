<?php
use League\Fractal;

/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 28/11/15
 * Time: 3:01 AM
 */
class StoreCommentTransformer  extends Fractal\TransformerAbstract
{
    /**
     * @param StoreComment $storeComment
     * @return array
     * @internal param User $user
     */
    public function transform(StoreComment $storeComment)
    {
        return [
            'id'    => (int) $storeComment['id'],
            'comment_id' => (int) $storeComment->comment->id,
            'comment' => $storeComment->comment->comment,
            'commenter_id' => $storeComment->commenter->id,
            'commenter_name' => $storeComment->commenter->profile->firstname . ', ' .
                            $storeComment->commenter->profile->lastname,
            'commenter_image' => $storeComment->commenter->profile->profile_image->large_image_url
        ];
    }
}