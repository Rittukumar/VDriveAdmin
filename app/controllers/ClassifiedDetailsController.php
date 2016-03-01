<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class ClassifiedDetailsController extends AppController {

	/**
	 * Display a listing of the resource.
	 * GET /storefront
	 *
	 * @param $classifiedId
	 * @return Response
	 */
	public function getClassifiedComments($classifiedId)
	{
		try {

			$paginator = ClassifiedComment::with('comment', 'commenter.profile.profile_image')
					->where('classified_id', $classifiedId)->orderBy('created_at', 'DESC')->paginate(10);

			$allComments = $paginator->getCollection();

			if (!$allComments) {
				return $this->responseNotFound('Comments not found!');
			}

			$fractal = new Manager();

			$classifiedCommentsResource = new Collection($allComments, new ClassifiedCommentTransformer());

			$classifiedCommentsResource->setPaginator(new IlluminatePaginatorAdapter($paginator));

			$data = $fractal->createData($classifiedCommentsResource);

			return $data->toJson();

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /storefront/create
	 *
	 * @return Response
	 */
	public function addClassifiedComment()
	{
		try {
			$input_array = Input::all();

			$storeId = (int)$input_array['classified_id'];
			$userId = (int)$input_array['user_id'];

			$comment = Comment::create([
					'comment' => $input_array['comment']
			]);

			$storeComment = ClassifiedComment::create([
					'classified_id' => $storeId,
					'user_id' => $userId,
					'comment_id' => $comment->id
			]);

			$successResponse = [
					'status' => true,
					'id' => $storeComment->id,
					'message' => 'Comment submitted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * update store comment
	 * @return mixed
	 */
	public function updateClassifiedComment()
	{
		try {
			$input_array = Input::all();

			$commentId = (int)$input_array['comment_id'];
			$updatedComment = $input_array['comment'];

			$comment = Comment::find($commentId);

			$comment->comment = $updatedComment;

			$comment->save();

			$successResponse = [
					'status' => true,
					'message' => 'Comment updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


	/**
	 * delete store comment
	 * @return mixed
	 */
	public function deleteClassifiedComment()
	{
		try {
			$input_array = Input::all();

			$storeCommentId = (int)$input_array['id'];

			$storeComment = ClassifiedComment::find($storeCommentId);

			$comment = Comment::find($storeComment->comment->id);

			$storeComment->delete();

			$comment->delete();

			$successResponse = [
					'status' => true,
					'message' => 'Comment deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /storefront
	 *
	 * @return Response
	 */
	public function addGrade()
	{
		try {
			$inputs_array = Input::all();

			$graderId = $inputs_array['grader_id'];
			$storeId = $inputs_array['classified_id'];
			$scale = $inputs_array['grade'];

			$storeGrade = ClassifiedGrade::where('grader_id', $graderId)
					->where('classified_id', $storeId)
					->first();

			$grade = null;

			if (!$storeGrade) {
				$grade = Grade::Create([
						'scale' => $scale,
				]);

				ClassifiedGrade::Create([
						'grader_id' => $graderId,
						'classified_id' => $storeId,
						'grade_id' => $grade->id,
				]);
			} else {
				$grade = Grade::find($storeGrade->grade_id);

				$grade->scale = $scale;

				$grade->save();
			}

			$avgGrade = ClassifiedGrade::join('grades', 'classified_grades.grade_id', '=', 'grades.id')
					->where('classified_grades.classified_id', $storeId)
					->avg('scale');

			$successResponse = [
					'status' => true,
					'message' => 'Graded successfully!',
					'avgGrade' => round($avgGrade, 1)
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
	 * GET /woicegrades/{id}
	 *
	 * @param $storeId
	 * @param $userId
	 * @return mixed
	 * @internal param int $id
	 */
	public function getClassifiedGrades($storeId, $userId)
	{
		try {
			$storeGrades = ClassifiedGrade::with('grade', 'grader')->where('classified_id', $storeId)->get();

			if (!$storeGrades) {
				return $this->responseNotFound('Classified grades not found!');
			}

			$storeGradesData['grades'] = $storeGrades;

			// Calculate the average grade
			$avgGrade = round(ClassifiedGrade::join('grades', 'classified_grades.grade_id', '=', 'grades.id')
					->where('classified_grades.classified_id', $storeId)->avg('scale'), 1);

			$storeGradesData['avg_grade'] = $avgGrade;

			// Find the user grade for the store.
			$userGrade = ClassifiedGrade::with('grade')->where('grader_id', $userId)
					->where('classified_id', $storeId)->first();

			if($userGrade)
				$storeGradesData['user_grade'] = $userGrade->grade->scale;
			else
				$storeGradesData['user_grade'] = 0;

			return $storeGradesData;

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 *
	 */
	public function createClassifiedStream() {
		try {
			$inputs_array = Input::all();

			$classifiedId = $inputs_array['classified_id'];
			$userId = $inputs_array['user_id'];

			try {
				$classified = Classified::with('images')->find($classifiedId);

				try {
					$rewoicePost = Post::create([
							'title' => $classified['title'],
							'owner_id' => $userId,
							'description' => $classified['description'],
							'visibility_id' => 1,
							'post_type_id' => 0,
					]);

					foreach ($classified->images as $image) {

						$titleImage = EvezownImage::create([
							'large_image_url' => $image->title_image_name
						]);

						PostImage::create([
								'image_id' => $titleImage->id,
								'post_id' => $rewoicePost->id
						]);

						$bodyImage1 = EvezownImage::create([
							'large_image_url' => $image->body_image1_name
						]);

						PostImage::create([
								'image_id' => $bodyImage1->id,
								'post_id' => $rewoicePost->id
						]);

						$bodyImage2 = EvezownImage::create([
							'large_image_url' => $image->body_image2_name
						]);

						PostImage::create([
								'image_id' => $bodyImage2->id,
								'post_id' => $rewoicePost->id
						]);

						$bodyImage3 = EvezownImage::create([
							'large_image_url' => $image->body_image3_name
						]);

						PostImage::create([
								'image_id' => $bodyImage3->id,
								'post_id' => $rewoicePost->id
						]);
					}

					// Create link for the store
					$link = Link::create([
							'url_link' => '#/classifieds/' . $classifiedId
					]);

					PostLink::create([
							'link_id' => $link->id,
							'post_id' => $rewoicePost->id
					]);

					ClassifiedStream::create([
							'post_id' => $rewoicePost->id,
							'user_id' => $userId,
							'classified_id' => $classifiedId,
					]);

				} catch(Exception $ex) {
					return $ex;
				}

				$resharesCount = count(ClassifiedStream::where('classified_id', $classifiedId)->get());

				$successResponse = [
						'status' => true,
						'message' => 'Post Restreamed Successfully!',
						'restreamsCount' => $resharesCount
				];

				return $this->setStatusCode(200)->respond($successResponse);
			} catch (Exception $e) {
				$errorMessage = [
						'status' => false,
						'message' => $e
				];

				return $this->setStatusCode(500)->respondWithError($errorMessage);
			}
		} catch (Exception $e) {
			$errorMessage = [
					'status' => false,
					'message' => "Something went wrong. Please try again later!",
					'Error Message' => $e
			];

			return $this->setStatusCode(500)->respondWithError($errorMessage);
		}
	}

	/**
	 * Get the count of restreams done on the store.
	 * @param $classifiedId
	 * @return mixed
	 */
	public function getClassifiedRestreams($classifiedId)
	{
		try {
			$classifiedRestreams = ClassifiedStream::where('classified_id', $classifiedId)->count();

			return $classifiedRestreams;

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

}