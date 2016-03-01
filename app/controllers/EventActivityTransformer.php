<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class EventActivityTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param WoiceEvent $event
     * @return array
     * @internal param UserProfile $user
     */
    public function transform(EventActivity $eventActivity)
    {
        return [
            'id'    => (int) $eventActivity->id,
            'event_id'    => (int) $eventActivity->event_id,
            'comment' => $eventActivity->comment,
            'user_id' => (int) $eventActivity->user_id,
            'profile' => $eventActivity->profile,
            'event' => $eventActivity->event,
            'images' => $eventActivity->images,
            'created_date' => $eventActivity->created_at,
            'updated_date' => $eventActivity->updated_at,
        ];
    }
}