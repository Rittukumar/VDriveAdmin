<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class BlogTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(Blog $blog)
    {
        return [
            'id'    => (int) $blog['id'],
            'author' => $blog->author,
            'title' => $blog['title'],
            'content' => $blog['content'],
            'status' => $blog['status'],
            'subcategory' => $blog['subcategory'],
            'comments' => $blog->comments,
            'visibility_id' => $blog->visibility_id,
            'coverImage' => $blog->blog_cover_image,
            'created_date' => $blog->created_at,
            'updated_date' => $blog->updated_at,
            'scale' => $blog->scale,
            'blog_image' => $blog->blog_image,
            'trending' => $blog->trending
        ];
    }
}