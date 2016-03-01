<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class AlbumTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(Album $album)
    {
        return [
            'id'    => (int) $album['id'],
            'title' => $album['name'],
            'description' => $album['description'],
            'owner_id' => $album['owner_id'],
            'visibility_id' => $album['visibility_id'],
            'images' => $album->images,
            'comments' => $album->comments,
            'grades' => $album->grades,
            'scale' => $album->scale
        ];
    }
}