<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ForumController extends AppController {

	protected $forumTransformer;

	function __construct(ForumTransformer $forumTransformer)
	{
		$this->forumTransformer = $forumTransformer;
	}
	/**
	 * Display a listing of the resource.
	 * GET /forum
	 *
	 * @return Response
	 */
	public function index()
	{
		try {
			$limit = Input::get('limit') ?: 15;

			$forums = Forum::with('replies.user.profile_image', 'created_by.profile_image', 'subcategory.category','trending')->paginate($limit);

			if (!$forums) {
				return $this->responseNotFound('Discussion Not Found!');
			}

			$fractal = new Manager();

			$forumsResource = new Collection($forums, new ForumTransformer());

			$forumsResource->setPaginator(new IlluminatePaginatorAdapter($forums));

			$data = $fractal->createData($forumsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Display a listing of the resource.
	 * GET /groups
	 *
	 * @return Response
	 */
	public function getMyForums($userId)
	{
        try {
            $limit = Input::get('limit') ?: 15;

            $forums = Forum::with('replies.user.profile_image', 'created_by.profile_image', 'subcategory.category')->where('owner_id', $userId)->paginate($limit);

            if (!$forums) {
                return $this->responseNotFound('Discussion Not Found!');
            }

            $fractal = new Manager();

            $forumsResource = new Collection($forums, new ForumTransformer());

            $forumsResource->setPaginator(new IlluminatePaginatorAdapter($forums));

            $data = $fractal->createData($forumsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /forum
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			$input = Input::all();

			$input_array = $input['data'];

			$forumCreated = Forum::create($input_array);

			$successResponse = [
				'status' => true,
				'id' => $forumCreated->id,
				'message' => 'Discussion topic created successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /forum/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($forumId)
	{
		try {
			$forums = Forum::with('replies.user.profile_image', 'created_by.profile_image', 'subcategory.category')->find($forumId);

			if (!$forums) {
				return $this->responseNotFound('Discussion Not Found!');
			}

            $avgGrade = ForumGrade::join('grades', 'forum_grades.grade_id', '=', 'grades.id')
                ->where('forum_grades.forum_id', $forumId)
                ->avg('scale');
            $forums->scale = number_format($avgGrade,1);

			$fractal = new Manager();

			$forumsResource = new Item($forums, new ForumTransformer());

			$data = $fractal->createData($forumsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /forum/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		try {
			$input = Input::all();

			$input_array = $input['data'];

			$forumId = $input_array['forum_id'];

			$forum = Forum::find($forumId);

			if (!$forum) {
				return $this->responseNotFound('Discussion Not Found!');
			}

			if(isset($input_array['title'])) {
				$forum->title = $input_array['title'];
			}

			if(isset($input_array['description'])) {
				$forum->description = $input_array['description'];
			}

			if(isset($input_array['sub_cat_id'])) {
				$forum->sub_cat_id = $input_array['sub_cat_id'];
			}

            if(isset($input_array['visibility_id'])) {
                $forum->visibility_id = $input_array['visibility_id'];
            }

			$forum->save();

			$successResponse = [
				'status' => true,
				'message' => 'Discussion topic updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Create a user reply to forum topic
	 * @return mixed
     */
	public function addReply() {
		try {
			$input = Input::all();

			$input_array = $input['data'];

			$reply = ForumReply::create($input_array);

			$reply->forum_id = $input_array['forum_id'];

			$reply->save();

			$successResponse = [
				'status' => true,
				'id' => $reply->id,
				'message' => 'User replied to Discussion successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


    public function storeForumGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $forum_id = $inputs_array['forum_id'];
            $scale = $inputs_array['scale'];


            $forumGrade = ForumGrade::where('grader_id', $ownerId)
                ->where('forum_id', $forum_id)
                ->first();

            $grade = null;

            if(! $forumGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                ForumGrade::Create([
                    'grader_id' => $ownerId,
                    'forum_id' => $forum_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($forumGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = ForumGrade::join('grades', 'forum_grades.grade_id', '=', 'grades.id')
                ->where('forum_grades.forum_id', $forum_id)
                ->avg('scale');

            $successResponse = [
                'status' => true,
                'message' => 'Graded Discussion successfully!',
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
    public function showGrade($forum_id)
    {
        $avgGrade = ForumGrade::join('grades', 'forum_grades.grade_id', '=', 'grades.id')
            ->where('forum_grades.forum_id', $forum_id)
            ->avg('scale');
        return number_format($avgGrade,1);

    }



    /**
	 * @param $replyId
	 * @return mixed
     */
	public function removeReply($replyId) {
		try {
			$reply = ForumReply::find($replyId);

			$reply->delete();

			$successResponse = [
				'status' => true,
				'message' => 'User reply deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * @param $replyId
	 * @return mixed
	 */
	public function updateReply() {
		try {
			$input = Input::all();

			$input_array = $input['data'];

			$replyId = $input_array['reply_id'];
			$replyContent = $input_array['reply'];

			$reply = ForumReply::find($replyId);

			if (!$reply) {
				return $this->responseNotFound('Reply Not Found!');
			}

			$reply->reply = $replyContent;

			$reply->save();

			$successResponse = [
				'status' => true,
				'message' => 'User reply updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

    public function getMyForum($userId)
    {
        try{
            $limit = Input::get('limit') ?: 15;

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
	 * Remove the specified resource from storage.
	 * DELETE /forum/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($forumId)
	{
		try {
			$forum = Forum::find($forumId);

			if (!$forum) {
				return $this->responseNotFound('Discussion topic does not exist!');
			}

			$forumReplies = ForumReply::where('forum_id', $forumId)->get();

			foreach ($forumReplies as $forumReply) {
				$forumReply->delete();
			}

			// Remove the entry from circle table.
			$forum->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Discussion topic deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

}