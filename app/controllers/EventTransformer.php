<?php

/**
 * Created by PhpStorm.
 * User: Vishu Venki @CreativeThoughts
 * Date: 05/01/15
 * Time: 5:57 PM
 */
use League\Fractal;

class EventTransformer extends Fractal\TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @param WoiceEvent $event
     * @return array
     * @internal param UserProfile $user
     */
    public function transform(WoiceEvent $event)
    {
        return [
            'id'    => (int) $event->id,
            'title'    => $event->title,
            'description' => $event->description,
            'start_date' => $event->start_date,
            'end_date'    => $event->end_date,
            'start_time'    => $event->start_time,
            'end_time'    => $event->end_time,
            'created_date'    => $event->created_at,
            'updated_date'    => $event->updated_at,
            'owner_id'    => $event->owner_id,
            'owner' => $event->owner,
            'visibility_id' => $event->visibility_id,
            'attendees' => $event->attendees,
            'event_image' => $event->event_image,
            'location' => $event->location,
            'scale' => $event->scale

        ];
    }
}