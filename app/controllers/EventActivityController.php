<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class EventActivityController extends AppController {

	/**
	 * Display a listing of the resource.
	 * GET /eventactivity
	 *
	 * @return Response
	 */
	public function index($eventId)
	{
		try{
			$limit = Input::get('limit') ?: 15;

			$eventActivities = EventActivity::with('event', 'images', 'profile.profile_image')->where('event_id', $eventId)->paginate($limit);

			if(! $eventActivities)
			{
				return $this->responseNotFound('Event activities Not Found!');
			}

			$fractal = new Manager();

			$eventActivitiesResource = new Collection($eventActivities, new EventActivityTransformer());

			$eventActivitiesResource->setPaginator(new IlluminatePaginatorAdapter($eventActivities));

			$data = $fractal->createData($eventActivitiesResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /eventactivity
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$userId = $input_array['user_id'];
			$comment = $input_array['comment'];
			$eventId = $input_array['event_id'];

			$event = WoiceEvent::find($eventId);

			if(! $event)
			{
				return $this->responseNotFound('Event does not Found!');
			}

			$eventActivity = EventActivity::create([
				'user_id' => $userId,
				'comment' => $comment,
				'event_id' => $eventId
			]);

			if (isset($input_array['images'])) {
				$images = $input_array['images'];

				foreach ($images as $imageName) {
					$evezImg = EvezownImage::create([
							'large_image_url' => $imageName
						]
					);

					$finalImg = EventActivityImage::create([
						'image_id' => $evezImg->id,
						'event_activity_id' => $eventActivity->id
					]);
				}
			}

			$successResponse = [
				'status' => true,
				'id' => $eventActivity->id,
				'message' => 'Event activity posted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /eventactivity/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$eventActivityId = $input_array['event_activity_id'];

			$eventActivity = EventActivity::find($eventActivityId);

			if(! $eventActivity)
			{
				return $this->responseNotFound('Event activity not Found!');
			}

			if (isset($input_array['comment'])) {
				$comment = $input_array['comment'];

				$eventActivity->comment = $comment;
			}

			$eventActivity->save();

			if (isset($input_array['images'])) {
				$images = $input_array['images'];

				foreach ($images as $imageName) {
					$evezImg = EvezownImage::create([
							'large_image_url' => $imageName
						]
					);

					$finalImg = EventActivityImage::create([
						'image_id' => $evezImg->id,
						'event_activity_id' => $eventActivity->id
					]);
				}
			}

			$successResponse = [
				'status' => true,
				'message' => 'Event activity updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


    public function storeEventActivityGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $event_activity_id = $inputs_array['event_activity_id'];
            $scale = $inputs_array['scale'];


            $eventActivityGrade = EventActivityGrade::where('grader_id', $ownerId)
                ->where('event_activity_id', $event_activity_id)
                ->first();

            $grade = null;

            if(! $eventActivityGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                EventActivityGrade::Create([
                    'grader_id' => $ownerId,
                    'event_activity_id' => $event_activity_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($eventActivityGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = EventActivityGrade::join('grades', 'event_activity_grades.grade_id', '=', 'grades.id')
                ->where('event_activity_grades.event_activity_id', $event_activity_id)
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
    public function showGrade($event_activity_id)
    {
        $avgGrade = EventActivityGrade::join('grades', 'event_activity_grades.grade_id', '=', 'grades.id')
            ->where('event_activity_grades.event_activity_id', $event_activity_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }

	/**
	 * Remove the specified resource from storage.
	 * DELETE /eventactivity/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		try {
			$eventActivity = EventActivity::find($id);

			if (!$eventActivity) {
				return $this->responseNotFound('Event activity does not exist!');
			}

			$eventActivityImages = EventActivityImage::where('event_activity_id', $id)->get();

			if ($eventActivityImages) {
				foreach ($eventActivityImages as $eventActivityImage) {
					$eventActivityImage->delete();
				}
			}

			// Remove the entry from event activity table.
			$eventActivity->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Event activity deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

}