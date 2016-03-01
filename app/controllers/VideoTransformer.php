<?php
/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 21/08/15
 * Time: 6:18 AM
 */

use League\Fractal;

class VideoTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param Video $video
     * @return array
     * @internal param News $news
     * @internal param User|UserProfile $user
     */
    public function transform(Video $video)
    {
        return [
            'id'    => (int) $video['id'],
            'title' => $video['title'],
            'link' => $video['link'],
            'priority' => (int)$video['priority'],
            'create_date' => $video['created_at'],
            'update_date' => $video['updated_at'],
        ];
    }
}