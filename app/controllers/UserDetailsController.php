<?php

use Illuminate\Support\Facades\App;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class UserDetailsController extends AppController
{

    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getPersonalInfo($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new PersonalInfoTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function savePersonalInfo()
    {
        try {

            $inputs = Input::all();

            //return $inputs;
            $repo = App::make('UserRepository');

            $result = $repo->savePersonalInfo($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Personal info updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }


    public function saveInterestInfo()
    {
        try {

            $result = 200;

            $inputs = Input::all();


            $repo = App::make('UserRepository');

            $result = $repo->saveInterestInfo($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Areas of Interest updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    public function getInterestInfo($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new InterestTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getEnhancedProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new EnhanceProfileTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function saveEnhancedProfile()
    {
        try {


            $inputs = Input::all();

            $repo = App::make('UserRepository');

            $result = $repo->saveEnhancedProfile($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Enhanced profile updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function saveFeedbackProfile()
    {
        try {

            $inputs = Input::all();

            $repo = App::make('UserRepository');

            $result = $repo->saveFeedbackProfile($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Feedback updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getOnlineProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new OnlineProfileTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getReferenceProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new ReferenceProfileTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }


    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getOtherServicesProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new OtherServicesTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }
    //other_services_profile

    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getParticipationProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new ParticipationProfileTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }


    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getPartneringProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new PartneringTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }

    /**
     * Display a listing of the resource.
     * GET /userdetails
     *
     * @param $userId
     * @return Response
     */
    public function getFeedbackProfile($userId)
    {
        try {
            $repo = App::make('UserRepository');

            $user = $repo->getUserProfileDetails($userId);

            if (!$user) {
                return $this->setStatusCode(404)->responseNotFound("User not found!");
            }

            $fractal = new Manager();

            $usersResource = new Item($user, new FeedbackTransformer());

            return $fractal->createData($usersResource)->toJson();
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error occurred!");
        }
    }


    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function saveOnlineProfile()
    {
        try {

            $inputs = Input::all();

            $repo = App::make('UserRepository');

            $result = $repo->saveOnlineProfile($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Online profile updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function savePartneringProfile()
    {
        try {

            $inputs = Input::all();

            $repo = App::make('UserRepository');

            try
            {
                $result = $repo->savePartneringProfile($inputs);
            }catch (Exception $ex)
            {
                return $ex;
            }


            return $result;


            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            if ($result == 200) {
                $successResponse = [
                    'status' => true,
                    'message' => 'Partnering with evezown profile updated successfully!'
                ];

                return
                    $this->setStatusCode($result)->respond($successResponse);

            } else {
                $errorResponse = [
                    'status' => false,
                    'message' => 'Partnering with evezown profile update failed!'
                ];
                $this->setStatusCode($result)->respondWithError($errorResponse);
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    //partnering_profile

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function saveOtherServicesProfile()
    {
        try {

            $inputs = Input::all();

            $repo = App::make('UserRepository');

            $result = $repo->saveOtherServicesProfile($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Other services profile updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function saveReferenceProfile()
    {
        try {

            $inputs = Input::all();

            $repo = App::make('UserRepository');

            $result = $repo->saveReferenceProfile($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Reference profile updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    /**
     * Show the form for creating a new resource.
     * GET /userdetails/create
     *
     * @param $input
     * @return Response
     */
    public function saveParticipationProfile()
    {
        try {

            $inputs = Input::all();

            $repo = App::make('UserRepository');

            $result = $repo->saveParticipationProfile($inputs);

            if ($result == 404) {
                return $this->setStatusCode($result)->responseNotFound("User not found!");
            }

            $successResponse = [
                'status' => true,
                'message' => 'Participation profile updated successfully!'
            ];

            return $this->setStatusCode($result)->respond($successResponse);
        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError("Error on save occurred!");
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /userdetails
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /userdetails/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /userdetails/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /userdetails/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /userdetails/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}