<?php
/**
 * Created by PhpStorm.
 * User: vishu
 * Date: 19/08/15
 * Time: 6:54 PM
 */
use League\Fractal;

class InterviewTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param News $interview
     * @return array
     * @internal param User|UserProfile $user
     */
    public function transform(Interview $interview)
    {
        return [
            'id'    => (int) $interview['id'],
            'title' => $interview['title'],
            'description' => $interview['description'],
            'link' => $interview['link'],
            'priority' => (int)$interview['priority'],
            'create_date' => $interview['created_at'],
            'update_date' => $interview['updated_at'],
            'interview_image' => $interview['interview_image'],
        ];
    }
}