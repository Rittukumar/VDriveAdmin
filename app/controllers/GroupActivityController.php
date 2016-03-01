<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class GroupActivityController extends AppController {

	/**
	 * Display a listing of the resource.
	 * GET /eventactivity
	 *
	 * @return Response
	 */
	public function index($groupId)
	{
		try {
			$limit = 15;
            try
            {
                $groupActivities = GroupActivity::with('group', 'images', 'links', 'comments.profile.profile_image', 'user.profile_image','grades.user')->where('group_id', $groupId)->paginate($limit);
            }catch (Exception $ex)
            {
                return $ex;
            }


			if (!$groupActivities) {
				$errorMessage = [
					'status' => false,
					'message' => "No post activities!"
				];

				return $this->setStatusCode(404)->responseNotFound($errorMessage);
			}

			$fractal = new Manager();

			$postsResource = new Collection($groupActivities, new GroupActivityTransformer());

			$postsResource->setPaginator(new IlluminatePaginatorAdapter($groupActivities));

			$data = $fractal->createData($postsResource);

			return $data->toJson();
		} catch (Exception $e) {
			$errorMessage = [
				'status' => false,
				'message' => "Error occurred!"
			];

			return $this->setStatusCode(500)->respondWithError($errorMessage);
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
		try {
			$input = Input::all();

			$inputs_array = $input['data'];

			$groupActivityArray = [];

			$groupActivityArray['user_id'] = $inputs_array['user_id'];
			$groupActivityArray['group_id'] = $inputs_array['group_id'];
			$groupActivityArray['title'] = $inputs_array['title'];
			$groupActivityArray['description'] = $inputs_array['description'];

			$group = Group::find($groupActivityArray['group_id']);

			if(!$group) {
				return $this->setStatusCode(404)->responseNotFound("Group does not exist");
			}

			// Create the group activity
			$groupActivity = GroupActivity::create($groupActivityArray);

			// If url link for the group activity is set then save it
			if (isset($inputs_array['url_link'])  && $inputs_array['url_link'] != null) {
				$url_link = $inputs_array['url_link'];




                foreach ($url_link as $lnk)
                {
                    try
                    {
                        $link = Link::create([
                            'url_link' => $lnk
                        ]);
                    }catch (Exception $ex){
                        return $ex;
                    }

                    $groupActivityLink = GroupActivityLink::create([
                        'group_activity_id' => $groupActivity->id,
                        'link_id' => $link->id
                    ]);

                }







			}

			if (isset($inputs_array['images'])) {
				$images = $inputs_array['images'];

				foreach ($images as $imageName) {
					$evezImg = EvezownImage::create([
							'large_image_url' => $imageName
						]
					);

					$finalImg = GroupActivityImage::create([
						'group_activity_id' => $groupActivity->id
					]);

					$finalImg->image_id = $evezImg->id;

					$finalImg->save();
				}
			}

			$successResponse = [
				'status' => true,
				'message' => 'Group post submitted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);
		} catch (Exception $e) {
			$errorMessage = [
				'status' => false,
				'message' => $e
			];

			return $this->setStatusCode(500)->respondWithError($errorMessage);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /eventactivity/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($groupActivityId)
	{
		try {
			$groupActivity = GroupActivity::with('group', 'images', 'links','comments.profile.profile_image', 'user.profile_image')->find($groupActivityId);

			if (!$groupActivity) {
				$errorMessage = [
					'status' => false,
					'message' => "Group activity does not exist!"
				];

				return $this->setStatusCode(404)->responseNotFound($errorMessage);
			}

            $avgGrade = GroupActivityGrade::join('grades', 'group_activity_grades.grade_id', '=', 'grades.id')
                ->where('group_activity_grades.group_activity_id', $groupActivityId)
                ->avg('scale');

            $groupActivity->scale = number_format($avgGrade,1);

			$fractal = new Manager();

			$groupActivityResource = new Item($groupActivity, new GroupActivityTransformer());

			$data = $fractal->createData($groupActivityResource);

			return $data->toJson();
		} catch (Exception $e) {
			$errorMessage = [
				'status' => false,
				'message' => "Error occurred!"
			];

			return $this->setStatusCode(500)->respondWithError($errorMessage);
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
		try {
			$input = Input::all();

			$inputs_array = $input['data'];

			$groupActivityArray = [];

			$groupActivityArray['group_activity_id'] = $inputs_array['group_activity_id'];

			$groupActivity = GroupActivity::find($groupActivityArray['group_activity_id']);

			if(!$groupActivity) {
				return $this->setStatusCode(404)->responseNotFound("Group activity does not exist");
			}

			if (isset($inputs_array['title'])) {
				$groupActivity->title = $inputs_array['title'];
			}

			if (isset($inputs_array['description'])) {
				$groupActivity->description = $inputs_array['description'];
			}

			// If url link for the group activity is set then save it
			if (isset($inputs_array['url_link'])) {
				$url_link = $inputs_array['url_link'];

				$link = Link::create([
					'url_link' => $url_link
				]);

				$groupActivityLink = GroupActivityLink::create([
					'group_activity_id' => $groupActivity->id
				]);

				$groupActivityLink->link_id = $link->id;

				$groupActivityLink->save();
			}

			if (isset($inputs_array['images'])) {
				$images = $inputs_array['images'];

				foreach ($images as $imageName) {
					$evezImg = EvezownImage::create([
							'large_image_url' => $imageName
						]
					);

					$finalImg = GroupActivityImage::create([
						'group_activity_id' => $groupActivity->id
					]);

					$finalImg->image_id = $evezImg->id;

					$finalImg->save();
				}
			}

			$successResponse = [
				'status' => true,
				'message' => 'Group post updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);
		} catch (Exception $e) {
			$errorMessage = [
				'status' => false,
				'message' => $e
			];

			return $this->setStatusCode(500)->respondWithError($errorMessage);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /eventactivity/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($groupActivityId)
	{
		try {
			$groupActivity = GroupActivity::find($groupActivityId);

			if(!$groupActivity) {
				return $this->setStatusCode(404)->responseNotFound("Group activity does not exist");
			}

			$groupActivityImages = GroupActivityImage::where('group_activity_id', $groupActivity->id)->get();

			// if images are included as part of a group activity, delete those.
			if ($groupActivityImages) {
				foreach ($groupActivityImages as $groupActivityImage) {

					$image = EvezownImage::find($groupActivityImage['image_id']);

					if($image)
					{
						$image->delete();
					}

					$groupActivityImage->delete();
				}
			}

			$groupActivitylinks = GroupActivityLink::where('group_activity_id', $groupActivity->id)->get();

			// if links is included as part of a group activity, delete those.
			if ($groupActivitylinks) {
				foreach ($groupActivitylinks as $groupActivitylink) {

					$link = Link::find($groupActivitylink['link_id']);

					if($link)
					{
						$link->delete();
					}

					$groupActivitylink->delete();
				}
			}

			$groupActivity->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Group activity deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Add blog comment
	 * @return mixed
	 */
	public function addComment()
	{
		try {
			$input = Input::all();

			$input_array = $input['data'];

			$groupActivityId = $input_array['group_activity_id'];
			$userId = $input_array['user_id'];
			$comment = $input_array['comment'];

			$createdComment = Comment::create([
				'comment' => $comment
			]);

			$commentId = $createdComment->id;

			$groupActivityComment = GroupActivityComment::create([
				'user_id' => $userId,
				'group_activity_id' => $groupActivityId
			]);

			$groupActivityComment->comment_id = $commentId;

			$groupActivityComment->save();

			$successResponse = [
				'status' => true,
				'id' => $groupActivityComment->id,
				'message' => 'Group activity comment added successfully!'
			];

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}
		return $this->setStatusCode(200)->respond($successResponse);

	}

	/**
	 * Add blog comment
	 * @return mixed
	 */
	public function updateComment()
	{
		try {
			$input = Input::all();

			$input_array = $input['data'];

			$commentId = $input_array['comment_id'];
			$commentToUpdate = $input_array['comment'];

			// Get the comment from comment table.
			$comment = Comment::find($commentId);

			$comment->comment = $commentToUpdate;

			$comment->save();

			$successResponse = [
				'status' => true,
				'message' => 'Group activity comment updated successfully!'
			];

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}
		return $this->setStatusCode(200)->respond($successResponse);
	}

    public function storeGroupActivityGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $group_activity_id = $inputs_array['group_activity_id'];
            $scale = $inputs_array['scale'];


            $groupActivityGrade = GroupActivityGrade::where('grader_id', $ownerId)
                ->where('group_activity_id', $group_activity_id)
                ->first();

            $grade = null;

            if(! $groupActivityGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                GroupActivityGrade::Create([
                    'grader_id' => $ownerId,
                    'group_activity_id' => $group_activity_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($groupActivityGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = GroupActivityGrade::join('grades', 'group_activity_grades.grade_id', '=', 'grades.id')
                ->where('group_activity_grades.group_activity_id', $group_activity_id)
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
    public function showGrade($group_activity_id)
    {
        $avgGrade = GroupActivityGrade::join('grades', 'group_activity_grades.grade_id', '=', 'grades.id')
            ->where('group_activity_grades.group_activity_id', $group_activity_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }

	/**
	 * remove blog comment
	 * @param $groupActivityCommentId
	 * @return mixed
	 */
	public function removeComment($commentId)
	{
		try {
			$activityComment = GroupActivityComment::where('comment_id', $commentId)->first();

			if(!$activityComment) {
				return $this->responseNotFound('Activity Comment does not exist!');
			}

			$comment = Comment::find($commentId);

			if(!$comment) {
				return $this->responseNotFound('Comment does not exist!');
			}

			$comment->delete();

			$activityComment->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Group activity comment deleted successfully!'
			];

		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}
		return $this->setStatusCode(200)->respond($successResponse);

	}

}