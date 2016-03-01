<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class EvezplaceRecommendationController extends AppController
{

    /**
     * Display the specified resource.
     * GET /adminevezplacepromotion/{id}
     *
     * @param $sectionId
     * @return Response
     * @internal param int $id
     */
    public function index($sectionId)
    {
        try {
            $evezplaceRecommendations = EvezplaceRecommendation::with('image', 'evezown_section')
                ->where('evezown_section_id', $sectionId)->orderBy('priority', 'desc')->paginate(20);

            if (!$evezplaceRecommendations) {
                return $this->responseNotFound('No evezown recommendation items exist!');
            }

            $fractal = new Manager();

            $evezplaceRecommendationResource = new Collection($evezplaceRecommendations,
                new EvezplaceRecommendationTransformer());

            $evezplaceRecommendationResource->setPaginator(new IlluminatePaginatorAdapter($evezplaceRecommendations));

            $data = $fractal->createData($evezplaceRecommendationResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Load evezown recommendation item used for auto save purpose
     * @param $recommendationId
     * @return Exception|mixed
     */
    public function show($recommendationId)
    {
        try {
            $evezplaceRecommendation = EvezplaceRecommendation::with('image')
                ->find($recommendationId);

            if (!$evezplaceRecommendation) {
                return $this->responseNotFound('No evezown recommendation item exist!');
            }

            return $evezplaceRecommendation;
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /evezplacerecommendation
     *
     * @param $user_id
     * @param $sectionId
     * @return Response
     */
    public function store($user_id, $sectionId)
    {
        try {
            $hasAdminRole = User::find($user_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $inputs_array = Input::all();

            $title = isset($inputs_array['title']) ? $inputs_array['title'] : "";
            $description = isset($inputs_array['description']) ? $inputs_array['description'] : "";
            $link = isset($inputs_array['link']) ? $inputs_array['link'] : "";
            $priority = isset($inputs_array['priority']) ? $inputs_array['priority'] : 0;

            if (isset($inputs_array['id'])) {
                $evezplaceRecommendation = EvezplaceRecommendation::find($inputs_array['id']);

                $evezplaceRecommendation->title = $title;
                $evezplaceRecommendation->description = $description;
                $evezplaceRecommendation->link = $link;
                $evezplaceRecommendation->evezown_section_id = $sectionId;
                $evezplaceRecommendation->priority = $priority;

                $evezplaceRecommendation->save();

            } else {
                $evezplaceRecommendation = EvezplaceRecommendation::create([
                    'evezown_section_id' => $sectionId,
                    'title' => $title,
                    'description' => $description,
                    'link' => $link,
                    'priority' => $priority,
                ]);
            }

            $successResponse = [
                'status' => true,
                'id' => $evezplaceRecommendation->id,
                'message' => 'Recommendation item added successfully!'
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
     * Upload promotion image for specific section
     * @param $user_id
     * @param $sectionId
     * @return mixed
     * @internal param $promotionSection
     */
    public function updateRecommendationImage($user_id, $sectionId)
    {
        try {

            $hasAdminRole = User::find($user_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $inputs_array = Input::all();

            $imageName = $inputs_array['imageName'];

            $evezownImage = EvezownImage::create([
                'large_image_url' => $imageName
            ]);

            try {
                if (isset($inputs_array['id'])) {
                    $evezplacePromotion = EvezplaceRecommendation::find($inputs_array['id']);
                    $evezplacePromotion->evezown_section_id = $sectionId;
                    $evezplacePromotion->image_id = $evezownImage->id;

                    $evezplacePromotion->save();
                } else {
                    $evezplacePromotion = EvezplaceRecommendation::create([
                        'evezown_section_id' => $sectionId,
                        'image_id' => $evezownImage->id
                    ]);
                }
            }
            catch(Exception $ex) {
                return $ex;
            }

            $successResponse = [
                'status' => true,
                'id' => $evezplacePromotion->id,
                'message' => 'Promotion image uploaded successfully!'
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
     * Update the specified resource in storage.
     * PUT /evezplacerecommendation/{id}
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
     * DELETE /evezplacerecommendation/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}