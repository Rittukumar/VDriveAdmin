<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class PostsTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(Post $post)
    {
        $avgGrade = round(PostGrade::join('grades', 'post_grades.grade_id', '=', 'grades.id')
                        ->where('post_grades.post_id', $post['id'])->avg('scale'), 1);

        if(empty($post['users']['deleted'] || $post['users']['blocked'])){

        return [
            'id'    => (int) $post['id'],
            'owner_id'    => (int) $post['owner_id'],
            'title'    => $post['title'],
            'description'    => $post['description'],
            'price_range'    => $post['price_range'],
            'testimonial'    => $post['testimonial'],
            'publish_date'    => $post['created_at'],
            'edit_date'    => $post['updated_at'],
            'visibility_id'    => (int) $post['visibility_id'],
            'post_type_id'    => (int) $post['post_type_id'],
            'priority' => (int) $post->priority,
            'brand'    =>  $post['brand'],
            'circle_id'    =>  $post['circle_id'],
            'images'    => $post['images'],
            'links' => $post['links'],
            'location' => $post['post_location'],
            'comments' => $post['comments'],
            'grades' => $post['grades'],
            'user'    => $post['user'],
            'commentsCount' => count($post['comments']),
            'avgGrade' => $avgGrade,
            'rewoicesCount' => count($post['rewoices']),
            'deleted' => 0
        ];

        }else{

            return ['deleted' => 1];

        }

    }
}