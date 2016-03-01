<?php
/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 19/08/15
 * Time: 6:49 PM
 */

use League\Fractal;

class NewsTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param News $news
     * @return array
     * @internal param User|UserProfile $user
     */
    public function transform(News $news)
    {
        return [
            'id'    => (int) $news['id'],
            'title' => $news['title'],
            'description' => $news['description'],
            'link' => $news['link'],
            'priority' => (int)$news['priority'],
            'create_date' => $news['created_at'],
            'update_date' => $news['updated_at'],
        ];
    }
}