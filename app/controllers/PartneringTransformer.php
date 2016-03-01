<?php
/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class PartneringTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param User|UserProfile $user
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'id'    => (int) $user['id'],
            'through_blogs' => $user->profile['through_blogs'],
            'through_forums' => $user->profile['through_forums'],
            'through_events' => $user->profile['through_events'],
            'through_recco' => $user->profile['through_recco'],
            'as_woice_user' => $user->profile['as_woice_user'],
            'as_evangelist' => $user->profile['as_evangelist'],
            'as_active_writer' => $user->profile['as_active_writer'],
            'as_ecommerce' => $user->profile['as_ecommerce'],
            'other_ideas' => $user->profile['other_ideas'],
            'interested_in_content_creation' => $user->profile['interested_in_content_creation']
        ];
    }
}