<?php

use League\Fractal\Manager;
use League\Fractal\Resource\Item;

class AdminEvezplacePromotionController extends AppController {


	/**
	 * Store a newly created resource in storage.
	 * POST /adminevezplacepromotion
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

			$leftSmallCaption = $inputs_array['left_small_caption'];
			$leftLargeCaption = $inputs_array['left_large_caption'];
			$leftLink = $inputs_array['left_link'];
			$leftButtonText = $inputs_array['left_button_text'];
			$rightTopSmallCaption = $inputs_array['right_top_small_caption'];
			$rightTopLink = $inputs_array['right_top_link'];
			$rightBottomSmallCaption = $inputs_array['right_bottom_small_caption'];
			$rightBottomLink = $inputs_array['right_bottom_link'];

			$evezplacePromotion = EvezplacePromotion::firstOrCreate([
					'evezown_section_id' => $sectionId
			]);

			$evezplacePromotion['left_small_caption'] = $leftSmallCaption;
			$evezplacePromotion['left_large_caption'] = $leftLargeCaption;
			$evezplacePromotion['left_link'] = $leftLink;
			$evezplacePromotion['left_button_text'] = $leftButtonText;
			$evezplacePromotion['right_top_small_caption'] = $rightTopSmallCaption;
			$evezplacePromotion['right_top_link'] = $rightTopLink;
			$evezplacePromotion['right_bottom_small_caption'] = $rightBottomSmallCaption;
			$evezplacePromotion['right_bottom_link'] = $rightBottomLink;

			$evezplacePromotion['evezown_section_id'] = $sectionId;

			$evezplacePromotion->save();

			$successResponse = [
					'status' => true,
					'message' => 'Promotion details saved successfully!'
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
	public function updatePromotionImage($user_id, $sectionId) {
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

			$promotionSection = $inputs_array['promotion_section'];
			$imageName = $inputs_array['imageName'];

			// section id = 3 for products
			$evezplacePromotion = EvezplacePromotion::firstOrCreate([
					'evezown_section_id' => $sectionId
			]);

			$evezownImage = EvezownImage::create([
				'large_image_url' => $imageName
			]);

			if($promotionSection == 1) {
				$evezplacePromotion['left_image_id'] = $evezownImage->id;
			}

			if($promotionSection == 2) {
				$evezplacePromotion['right_top_image_id'] = $evezownImage->id;
			}

			if($promotionSection == 3) {
				$evezplacePromotion['right_bottom_image_id'] = $evezownImage->id;
			}

			$evezplacePromotion->save();

			$successResponse = [
					'status' => true,
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
			$evezplacePromotion = EvezplacePromotion::with('left_image', 'right_top_image', 'right_bottom_image')
									->where('evezown_section_id', $sectionId)->first();

			if (!$evezplacePromotion) {
				return $this->responseNotFound('No store promotion items added!');
			}

			$fractal = new Manager();

			$evezplacePromotionResource = new Item($evezplacePromotion, new EvezplacePromotionTransformer());

			$data = $fractal->createData($evezplacePromotionResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $e;
		}
	}
}