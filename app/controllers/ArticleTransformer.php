<?php
/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 19/08/15
 * Time: 6:52 PM
 */

use League\Fractal;

class ArticleTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param News $articles
     * @return array
     * @internal param User|UserProfile $user
     */
    public function transform(Article $articles)
    {
        return [
            'id'    => (int) $articles['id'],
            'title' => $articles['title'],
            'description' => $articles['description'],
            'link' => $articles['link'],
            'priority' => (int)$articles['priority'],
            'create_date' => $articles['created_at'],
            'update_date' => $articles['updated_at'],
        ];
    }
}