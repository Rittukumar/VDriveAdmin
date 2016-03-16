<?php

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class FriendsController extends AppController {

	protected $friendTransformer;

	function __construct(FriendTransformer $friendTransformer)
	{
		$this->friendTransformer = $friendTransformer;
	}

	/**
	 * Display a listing of the resource.
	 * GET /friends
	 *
	 * @param null $id
	 * @return Response
	 */
	public function index($id)
	{
		try{
			$limit = Input::get('limit') ?: 15;

			$friends = Friend::with('profile','profile.profile_image')->where('user_id', $id)->paginate($limit);

			if(! $friends)
			{
				return $this->responseNotFound('Friends Not Found!');
			}

			$fractal = new Manager();

//			$usersResource = new Collection($friends, new FriendTransformer());
//
//			$usersResource->setPaginator(new IlluminatePaginatorAdapter($friends));
//
//			$data = $fractal->createData($usersResource);

			return $friends->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

    public function getFriendsForCircle($id,$circle_id)
    {
        try{
            $limit = Input::get('limit') ?: 15;
            //$friends = Friend::with('profile','profile.profile_image')->where('user_id', $id)->paginate($limit);
            $friends = Friend::with('profile', 'profile.profile_image')->where('user_id', $id)
                ->whereNotExists(function ($query) use ($id,$circle_id) {
                    $query->select(DB::raw(1))
                        ->from('circle_friends')
                        ->whereRaw('circle_friends.friend_user_id = friends.friend_user_id and circle_id = '.$circle_id);
                })
                ->paginate($limit);
            if(! $friends)
            {
                return $this->responseNotFound('Friends Not Found!');
            }

            $fractal = new Manager();

//			$usersResource = new Collection($friends, new FriendTransformer());
//
//			$usersResource->setPaginator(new IlluminatePaginatorAdapter($friends));
//
//			$data = $fractal->createData($usersResource);

            return $friends->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getFriendsForGroup($id,$group_id)
    {
        try{
            $limit = Input::get('limit') ?: 15;
            //$friends = Friend::with('profile','profile.profile_image')->where('user_id', $id)->paginate($limit);
            $friends = Friend::with('profile', 'profile.profile_image')->where('user_id', $id)
                ->whereNotExists(function ($query) use ($id,$group_id) {
                    $query->select(DB::raw(1))
                        ->from('group_user_profile')
                        ->whereRaw('group_user_profile.user_id = friends.friend_user_id')
                        ->whereRaw('group_user_profile.status ="approved"')
                        ->whereRaw('group_user_profile.group_id='.$group_id);
                })
                ->paginate($limit);
            if(! $friends)
            {
                return $this->responseNotFound('Friends Not Found!');
            }

            $fractal = new Manager();

//			$usersResource = new Collection($friends, new FriendTransformer());
//
//			$usersResource->setPaginator(new IlluminatePaginatorAdapter($friends));
//
//			$data = $fractal->createData($usersResource);

            return $friends->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getFriendsForEvents($id,$event_id)
    {
        try{
            $limit = Input::get('limit') ?: 15;
            //$friends = Friend::with('profile','profile.profile_image')->where('user_id', $id)->paginate($limit);
            $friends = Friend::with('profile', 'profile.profile_image')->where('user_id', $id)
                ->whereNotExists(function ($query) use ($id,$event_id) {
                    $query->select(DB::raw(1))
                        ->from('event_invites')
                        ->whereRaw('event_invites.friend_user_id = friends.friend_user_id')
                        ->whereRaw('event_invites.rsvp="yes"')
                        ->whereRaw('event_invites.event_id='.$event_id);
                })
                ->paginate($limit);
            if(! $friends)
            {
                return $this->responseNotFound('Friends Not Found!');
            }

            $fractal = new Manager();

//			$usersResource = new Collection($friends, new FriendTransformer());
//
//			$usersResource->setPaginator(new IlluminatePaginatorAdapter($friends));
//
//			$data = $fractal->createData($usersResource);

            return $friends->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

	/**
	 * @return Send friend request
	 *  status = 0
     */
	public function sendFriendRequest(){
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$friend_user_id  = $input_array['friend_user_id'];
			$user_id  = $input_array['user_id'];

			$friendRequest = FriendRequest::where('friend_user_id', $friend_user_id)
						   ->where('user_id', $user_id)->first();

			if($friendRequest != null) {
				return $this->setStatusCode(403)->respondWithError('Friend request already sent');
			}

			$friendRequest = FriendRequest::where('user_id', $friend_user_id)
				->where('friend_user_id', $user_id)->first();

			if($friendRequest != null) {
				return $this->setStatusCode(403)->respondWithError('Friend request already received from user');
			}

			// Friend request send with status 0 (request sent status = 0)
			FriendRequest::create([
				'friend_user_id' => $friend_user_id,
				'user_id' => $user_id,
				'status' => 0
			]);

			$successResponse = [
				'status' => true,
				'message' => 'Eve request sent successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


	/**
	 * Get all friend requests which are not yet responded.
	 * @param $user_id
	 * @return string
     */
	public function getAllFriendRequests($user_id) {
		$limit = Input::get('limit') ?: 15;

		$friendRequests = FriendRequest::with('requester.profile_image')->where('friend_user_id', $user_id)
										->where('status', 0)->paginate($limit);

		$fractal = new Manager();

		$friendRequestsResource = new Collection($friendRequests, new FriendRequestTransformer);

		$friendRequestsResource->setPaginator(new IlluminatePaginatorAdapter($friendRequests));

		$data = $fractal->createData($friendRequestsResource);

		return $data->toJson();
	}

	/**
	 * @return Accept friend request
	 *  status = 0
	 */
	public function acceptFriendInviteRequest(){
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$invite_id  = $input_array['invite_id'];

			$friendRequest = FriendRequest::find($invite_id);

			if($friendRequest != null && $friendRequest->status == 0) {
				$friendRequest->status = 1;
				$friendRequest->save();
			}
			else
			{
				return $this->setStatusCode(403)->respondWithError('Eve request is no more valid or is already accepted');
			}

			// Create the friend entry and set the status to active.
			Friend::create([
				'user_id' => $friendRequest->user_id,
				'friend_user_id' => $friendRequest->friend_user_id,
				'status' => 1
			]);

			// Make sure that the second user also has a mapping of the friendship.
			Friend::create([
				'user_id' => $friendRequest->friend_user_id,
				'friend_user_id' => $friendRequest->user_id,
				'status' => 1
			]);

			$successResponse = [
				'status' => true,
				'message' => 'Eve request accepted!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * @return Auto friend
	 *  
	 */
	public function autoFriend(){
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$userid  = $input_array['UserID'];

			$referrer  = $input_array['referrer'];

			$RefererID = User::where('email', $referrer)->first();

			$refererid = $RefererID->id;

			// Create the friend entry and set the status to active.
			Friend::create([
				'user_id' => $userid,
				'friend_user_id' => $refererid,
				'status' => 1
			]);

			// Make sure that the second user also has a mapping of the friendship.
			Friend::create([
				'user_id' => $refererid,
				'friend_user_id' => $userid,
				'status' => 1
			]);

			$successResponse = [
				'status' => true,
				'message' => 'Auto friend Success'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


	/**
	 * @return Accept friend request
	 *  status = 0
	 */
	public function rejectFriendInviteRequest(){
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$invite_id  = $input_array['invite_id'];

			$friendRequest = FriendRequest::find($invite_id);

			if($friendRequest != null && $friendRequest->status == 0) {
				$friendRequest->status = -1;
				$friendRequest->save();
			}
			else
			{
				return $this->setStatusCode(403)->respondWithError('Eve request is no more valid or is already accepted');
			}

			$successResponse = [
				'status' => true,
				'message' => 'Eve request rejected!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


	/**
	 * Store a newly created resource in storage.
	 * POST /friends
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /friends/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 * PUT /friends/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /friends/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}