<?php

class WoiceCommentsController extends AppController {

	/**
	 * Store a newly created resource in storage.
	 * POST /woicecomments
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			$input = Input::all();

			$inputs_array = $input['data'];

			$comment = Comment::Create([
				'comment' => $inputs_array['comment'],
			]);

			$postComment = PostComment::Create([
				'owner_id' => $inputs_array['owner_id'],
				'post_id' => $inputs_array['post_id'],
				'comment_id' => $comment->id,
			]);

			if (!$postComment) {
				$errorMessage = [
					'status' => false,
					'message' => "Something went wrong. Please try again later!"
				];

				return $this->setStatusCode(500)->respondWithError($errorMessage);
			}

			$successResponse = [
				'status' => true,
                'message' => 'Comment posted successfully!'
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
	 * GET /woicecomments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($post_id)
	{
		$postComments = PostComment::with('comment', 'user', 'user.profile_image')->where('post_id', $post_id)->get();

		return $postComments;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /woicecomments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($post_id, $comment_id)
	{
		try {
			$input = Input::all();

			$inputs_array = $input['data'];

			$postComment = Comment::find($comment_id);

			$postComment->comment = $inputs_array['comment'];

			$postComment->save();

			$successResponse = [
				'status' => true,
				'message' => 'Comment updated successfully!'
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
	 * Remove the specified resource from storage.
	 * DELETE /woicecomments/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($post_id, $comment_id)
	{
		try {

			$comment = PostComment::where('comment_id', $comment_id)->first();

			if(! $comment)
			{
				$errorMessage = [
					'status' => false,
					'message' => "Comment does not exist!"
				];

				return $this->setStatusCode(404)->respondWithError($errorMessage);
			}

			$comment->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Comment deleted successfully!'
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

}