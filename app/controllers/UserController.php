<?php

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;

class UserController extends AppController {

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		try {
			$input = Input::all();

			$userProfile = array(
				'firstname' => $input['firstname'],
				'lastname' => $input['lastname'],
				'email' => $input['email'],
				'password' => Hash::make($input['password']),
				'active' => 1
			);

			$userResponse = UserProfile::create($userProfile);

			return $userResponse;
		} catch (Exception $e) {
			return $this->setStatusCode(-1)->respondWithError('Error occured!');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
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
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		UserProfile::destroy($id);
	}

	/**
	 * @param $data
	 * @param $users
	 * @return mixed
	 */
	protected function responseWithPagination($data, $users)
	{

	}
}