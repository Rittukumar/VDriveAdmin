<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class CirclesController extends AppController {

	protected $circleTransformer;

	function __construct(CircleTransformer $circleTransformer)
	{
		$this->circleTransformer = $circleTransformer;
	}

	/**
	 * Display a listing of the resource.
	 * GET /circles
	 *
	 * @return Response
	 */
	public function index()
	{
		try{
			$limit = Input::get('limit') ?: 15;

			$circles = Circle::with('friends.profile')->paginate($limit);
			if(! $circles)
			{
				return $this->responseNotFound('Circles Not Found!');
			}

			$fractal = new Manager();

			$circlesResource = new Collection($circles, new CircleTransformer());

			$circlesResource->setPaginator(new IlluminatePaginatorAdapter($circles));

			$data = $fractal->createData($circlesResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	public function getMyCircles($userId) {
		try{
			$limit = Input::get('limit') ?: 15;

			$circles = Circle::with('friends.profile.profile_image')->where('user_id', $userId)->paginate($limit);

			if(! $circles)
			{
				return $this->responseNotFound('Circles Not Found!');
			}

			$fractal = new Manager();

			$circlesResource = new Collection($circles, new CircleTransformer());

			$circlesResource->setPaginator(new IlluminatePaginatorAdapter($circles));

			$data = $fractal->createData($circlesResource);

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
	public function showCircle($circle_id)
	{
		try{
			$limit = Input::get('limit') ?: 15;

			$circle = Circle::with('friends.profile.profile_image')->find($circle_id);

			if(! $circle)
			{
				return $this->responseNotFound('Circles Not Found!');
			}

			$fractal = new Manager();

			$circlesResource = new Item($circle, new CircleTransformer());

			$data = $fractal->createData($circlesResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Create circle
	 * @return mixed
     */
	public function store() {
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$userId = $input_array['user_id'];
			$title = $input_array['title'];
			$description = $input_array['description'];
            $visibility_id = $input_array['visibility_id'];

			$circle = Circle::create([
				'user_id' => $userId,
				'title' => $title,
				'description' => $description,
                'visibility_id' => $visibility_id
			]);

			$successResponse = [
				'status' => true,
				'id' => $circle->id,
				'message' => 'Circle created successfully!'
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
	public function addToCircle()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$friendUserId = $input_array['friend_user_id'];
			$circleId = $input_array['circle_id'];


			$circleFriend = CircleFriend::create([
				'circle_id' => $circleId,
				'friend_user_id' => $friendUserId,
			]);

			$successResponse = [
				'status' => true,
				'id' => $circleFriend->id,
				'message' => 'Friend added to circle successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Remove a friend from circle
	 * @return mixed
     */
	public function removeFromCircle()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$friendUserId = $input_array['friend_user_id'];
			$circleId = $input_array['circle_id'];

			$circleFriend = CircleFriend::where('circle_id', $circleId)
									->where('friend_user_id', $friendUserId)->first();

			if(!$circleFriend) {
				return $this->responseNotFound('Friend not found in circle!');
			}

			$circleFriend->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Friend removed from circle successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /circles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$circleId =  $input_array['circle_id'];

			$circle = Circle::find($circleId);

			if(!$circle)
			{
				return $this->responseNotFound('Circle does not exist!');
			}

			if(isset($input_array['title']))
			{
				$title = $input_array['title'];

				$circle->title = $title;
			}

			if(isset($input_array['description']))
			{
				$description = $input_array['description'];

				$circle->description = $description;
			}

            if(isset($input_array['visibility_id']))
            {
                $visibility_id = $input_array['visibility_id'];

                $circle->visibility_id = $visibility_id;
            }

			// Update circle.
			$circle->save();

			$successResponse = [
				'status' => true,
				'message' => 'Circle updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /circles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($circleId)
	{
		try{
			$circle = Circle::find($circleId);

			if(!$circle)
			{
				return $this->responseNotFound('Circle does not exist!');
			}

			$circleFriends = CircleFriend::where('circle_id', $circleId)->get();

			foreach ($circleFriends as $circleFriend) {
				$circleFriend->delete();
			}

			// Remove the entry from circle table.
			$circle->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Circle deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

}