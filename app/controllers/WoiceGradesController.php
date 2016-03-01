<?php

class WoiceGradesController extends AppController {

	/**
	 * Store a newly created resource in storage.
	 * POST /woicegrades
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			$input = Input::all();

			$inputs_array = $input['data'];

			$ownerId = $inputs_array['owner_id'];
			$postId = $inputs_array['post_id'];
			$scale = $inputs_array['scale'];

			$postGrade = PostGrade::where('owner_id', $ownerId)
								->where('post_id', $postId)
								->first();

			$grade = null;

			if(! $postGrade)
			{
				$grade = Grade::Create([
					'scale' => $scale,
				]);

				PostGrade::Create([
					'owner_id' => $ownerId,
					'post_id' => $postId,
					'grade_id' => $grade->id,
				]);
			}
			else
			{
				$grade = Grade::find($postGrade->grade_id);

				$grade->scale = $scale;

				$grade->save();
			}

			$avgGrade = PostGrade::join('grades', 'post_grades.grade_id', '=', 'grades.id')
							->where('post_grades.post_id', $postId)
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
	 * GET /woicegrades/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($post_id)
	{
		$postComments = PostGrade::with('grade', 'user')->where('post_id', $post_id)->get();

		return $postComments;
	}
}