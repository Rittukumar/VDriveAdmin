<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class EventController extends AppController {

	protected $eventTransformer;

	function __construct(EventTransformer $eventTransformer)
	{
		$this->eventTransformer = $eventTransformer;
	}

	/**
	 * Display a listing of the resource.
	 * GET /event
	 *
	 * @return Response
	 */
	public function index()
	{
		try{
			$limit = Input::get('limit') ?: 50;

			$events = WoiceEvent::with('attendees.profile.profile_image',
									'event_image', 'location','owner','trending')
									->paginate($limit);

			if(! $events)
			{
				return $this->responseNotFound('Events Not Found!');
			}

			$fractal = new Manager();

			$eventsResource = new Collection($events, new EventTransformer());

			$eventsResource->setPaginator(new IlluminatePaginatorAdapter($events));

			$data = $fractal->createData($eventsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

    public function getMyEvents($userId)
    {
        try{
            $limit = Input::get('limit') ?: 50;

            $events = WoiceEvent::with('attendees.profile.profile_image', 'event_image', 'location', 'owner')->where('owner_id', $userId)
                ->paginate($limit);

            if(! $events)
            {
                return $this->responseNotFound('Events Not Found!');
            }

            $fractal = new Manager();

            $eventsResource = new Collection($events, new EventTransformer());

            $eventsResource->setPaginator(new IlluminatePaginatorAdapter($events));

            $data = $fractal->createData($eventsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

	/**
	 * @param $id
	 * @return mixed|string
     */
	public function getMyInvites($id) {
		try{
			$limit = Input::get('limit') ?: 15;

			$events = WoiceEvent::with('attendees.profile.profile_image', 'event_image', 'location','grades')
				->where('owner_id', $id)->paginate($limit);

			if(! $events)
			{
				return $this->responseNotFound('Events Not Found!');
			}

			$fractal = new Manager();

			$eventsResource = new Collection($events, new EventTransformer());

			$eventsResource->setPaginator(new IlluminatePaginatorAdapter($events));

			$data = $fractal->createData($eventsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Display a listing of the resource.
	 * GET /circles
	 *
	 * @return Response
	 */
	public function showEvent($event_id)
	{
		try{
			$event = WoiceEvent::with('attendees.profile.profile_image', 'event_image', 'location')->find($event_id);

            $avgGrade = EventGrade::join('grades', 'event_grades.grade_id', '=', 'grades.id')
                ->where('event_grades.event_id', $event_id)
                ->avg('scale');

            $event->scale = number_format($avgGrade,1);

			if(! $event)
			{
				return $this->responseNotFound('Event Not Found!');
			}

			$fractal = new Manager();

			$eventsResource = new Item($event, new EventTransformer());

			$data = $fractal->createData($eventsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


    /**
     * Delete Event based on event Id.
     * GET /events
     *
     * @return Response
     */
    public function deleteEvent($event_id)
    {
        try{
            $event = WoiceEvent::where('id', $event_id)->first();
            if (!$event) {
                $errorMessage = [
                    'status' => false,
                    'message' => "event not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }
            $event->delete();
            $successResponse = [
                'status' => true,
                'message' => 'event removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

	/**
	 * Store a newly created resource in storage.
	 * POST /event
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$userId = $input_array['user_id'];
			$title = $input_array['title'];
			$description = $input_array['description'];
			$startDate = $input_array['start_date'];
			$endDate = $input_array['end_date'];
			$startTime = $input_array['start_time'];
			$endTime = $input_array['end_time'];
            $visibility_id = $input_array['visibility_id'];

			$event = WoiceEvent::create([
				'owner_id' => $userId,
				'title' => $title,
				'description' => $description,
				'start_date' => $startDate,
				'end_date' => $endDate,
				'start_time' => $startTime,
				'end_time' => $endTime,
                'visibility_id' => $visibility_id
			]);

			// Parse the google location details and store.
			if (isset($input_array['location'])) {

				$location = $input_array['location'];

				$address_parts = array(
					'street_address' => array("neighborhood"),
					'street_address2' => array("sublocality_level_3", "sublocality"),
					'locality' => array('sublocality_level_1', 'sublocality'),
					'city' => array('locality'),
					'state' => array('administrative_area_level_1'),
					'country' => array('country'),
					'zip' => array('postal_code'),
				);

				if (!empty($location))
                {
                    if(isset($location['address_components']))
                    {
                        $ac = $location['address_components'];
                        foreach($address_parts as $need=>$types) {
                            foreach($ac as $a) {
                                if (in_array($a['types'][0],$types))
                                {
                                    $locationToStore[$need] = $a['long_name'];

                                    if($a['types'][0] == 'administrative_area_level_1')
                                    {
                                        $locationToStore['state_code'] = $a['short_name'];
                                    }
                                    if($a['types'][0] == 'country')
                                    {
                                        $locationToStore['country_code'] = $a['short_name'];
                                    }
                                }
                                elseif (empty($locationToStore[$need]))
                                {
                                    $locationToStore[$need] = '';
                                }
                            }
                        }

                        $createdLocation = Location::create($locationToStore);
                        EventLocation::create([
                            'location_id' => $createdLocation->id,
                            'event_id' => $event['id']
                        ]);
                    }

				}
			}

			$successResponse = [
				'status' => true,
				'id' => $event->id,
				'message' => 'Event created successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

    /**
     * @param $userId
     * @return mixed|string
     */
    public function getCoverPic($eventId)
    {
        try {
            $coverImagePointer = EventImage::where('event_id', $eventId)->first();

            if(! $coverImagePointer)
            {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.

                return "NoCoverImage";
            }
            else
            {
                if ($coverImagePointer->image_id != 0)
                {
                    $coverImage = EvezownImage::where('id', $coverImagePointer->image_id)->orderBy('created_at', 'DESC')->first();
                    return $coverImage->large_image_url;
                }
                else
                {
                    return "NoCoverImage";
                }
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }
	/**
	 * @return mixed
     */
	public function updateEventPhoto() {
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$eventId = $input_array['event_id'];
			$imageName = $input_array['image_name'];

			$image = EvezownImage::create([
					'large_image_url' => $imageName
				]
			);

            $eventImage = EventImage::firstOrCreate(array('event_id' => $eventId));

            $eventImage->image_id = $image->id;

            $eventImage->save();


			$successResponse = [
				'status' => true,
				'message' => 'Images updated for event successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Add a friend to circle
	 * POST /circles
	 *
	 * @return Response
	 */
	public function InviteToEvent()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$friendUserId = $input_array['friend_user_id'];
			$eventId = $input_array['event_id'];
            $eventInvite = EventInvite::where('event_id', $eventId)
                ->where('friend_user_id', $friendUserId)
                ->first();

            if(!$eventInvite)
            {
                $eventInvite = EventInvite::create([
                    'event_id' => $eventId,
                    'friend_user_id' => $friendUserId
                ]);
            }
            else
            {
                return $this->setStatusCode(404)->respondWithError("Invite already sent");
            }


			$successResponse = [
				'status' => true,
				'id' => $eventInvite->id,
				'message' => 'Friend invited to event successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 *  Get all event invites of a user.
	 * @param $userId
	 * @return mixed
     */
	public function getEventInvites($userId) {
		try{
			$eventInvite = EventInvite::with('event')->where('friend_user_id', $userId)
										->where('rsvp', null)->get();

			return $this->setStatusCode(200)->respond($eventInvite);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Add a friend to circle
	 * POST /circles
	 *
	 * @return Response
	 */
	public function rsvpToEvent()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$rsvp = $input_array['rsvp'];
			$friendUserId = $input_array['friend_user_id'];
			$eventId = $input_array['event_id'];

			$eventInvite = EventInvite::where('event_id', $eventId)
										->where('friend_user_id', $friendUserId)
										->first();

			if(! $eventInvite)
			{
				return $this->responseNotFound('Event invite does not exist!');
			}

			$eventInvite->rsvp = $rsvp;

			$eventInvite->save();

			$successResponse = [
				'status' => true,
				'message' => 'Rsvp to event successfully completed!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /event/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$eventId =  $input_array['event_id'];

            $locationId = $input_array['locationId'];

			$event = WoiceEvent::find($eventId);


			if(!$event)
			{
				return $this->responseNotFound('Event does not exist!');
			}

			if(isset($input_array['title']))
			{
				$title = $input_array['title'];

				$event->title = $title;
			}

            if(isset($input_array['visibility_id']))
            {
                $visibility_id = $input_array['visibility_id'];

                $event->visibility_id = $visibility_id;
            }

			if(isset($input_array['description']))
			{
				$description = $input_array['description'];

				$event->description = $description;
			}

			if(isset($input_array['start_date']))
			{
				$startDate = $input_array['start_date'];

				$event->start_date = $startDate;
			}

			if(isset($input_array['end_date']))
			{
				$endDate = $input_array['end_date'];

				$event->end_date = $endDate;
			}



			if(isset($input_array['start_time']))
			{
				$startTime = $input_array['start_time'];

				$event->start_time = $startTime;
			}

			if(isset($input_array['end_time']))
			{
				$endTime = $input_array['end_time'];

				$event->end_time = $endTime;
			}

			// Parse the google location details and store.
			if (isset($input_array['location']))
            {
				$location = $input_array['location'];
				$address_parts = array(
					'street_address' => array("neighborhood"),
					'street_address2' => array("sublocality_level_3", "sublocality"),
					'locality' => array('sublocality_level_1', 'sublocality'),
					'city' => array('locality'),
					'state' => array('administrative_area_level_1'),
					'country' => array('country'),
					'zip' => array('postal_code'),
				);


				if (!empty($location))
                {

                    if(isset($location['address_components']))
                    {
                        $ac = $location['address_components'];
                        $locationToUpdate = Location::find($locationId);
                        foreach($address_parts as $need=>$types) {
                            foreach($ac as $a) {
                                if (in_array($a['types'][0],$types))
                                {
                                    $locationToUpdate[$need] = $a['long_name'];

                                    if($a['types'][0] == 'administrative_area_level_1')
                                    {
                                        $locationToUpdate['state_code'] = $a['short_name'];
                                    }
                                    if($a['types'][0] == 'country')
                                    {
                                        $locationToUpdate['country_code'] = $a['short_name'];
                                    }
                                }
                                elseif (empty($locationToUpdate[$need]))
                                {
                                    $locationToUpdate[$need] = '';
                                }
                            }
                        }

                        //$locationToUpdate = $locationToStore;
                        $locationToUpdate->save();
                    }


				}


			}
			// Update circle.
			$event->save();

			$successResponse = [
				'status' => true,
				'message' => 'Event updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


    public function storeEventGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $event_id = $inputs_array['event_id'];
            $scale = $inputs_array['scale'];


            $evenGrade = EventGrade::where('grader_id', $ownerId)
                ->where('event_id', $event_id)
                ->first();

            $grade = null;

            if(! $evenGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                EventGrade::Create([
                    'grader_id' => $ownerId,
                    'event_id' => $event_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($evenGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = EventGrade::join('grades', 'event_grades.grade_id', '=', 'grades.id')
                ->where('event_grades.event_id', $event_id)
                ->avg('scale');

            $successResponse = [
                'status' => true,
                'message' => 'Graded successfully!',
                'avgGrade' => round($avgGrade,1)
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Something went wrong. Please try again later!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Display the specified resource.
     * GET /album_image_grades/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function showGrade($event_id)
    {
        $avgGrade = EventGrade::join('grades', 'event_grades.grade_id', '=', 'grades.id')
            ->where('event_grades.event_id', $event_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /event/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($eventId)
	{
		try {
			$event = WoiceEvent::find($eventId);

			$eventInvites = EventInvite::where('event_id')->get();

			if ($eventInvites) {
				foreach ($eventInvites as $eventInvite) {

					$eventInvite->delete();
				}
			}

			$event->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Event deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}
}