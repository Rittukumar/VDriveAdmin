<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ScreenController extends AppController {


	public function getScreens()
	{
		
		try {
            $screens = Screens::all();

            $fractal = new Manager();

            $screensResource = new Collection($screens, new ScreenTransformer);

            $data = $fractal->createData($screensResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
	}


	public function getScreenField($adminId,$Id)
	{
		try {
            $screensFields = ScreenFields::where('screen_id', '=', $Id)->get();

            $fractal = new Manager();

            $screensFieldsResource = new Collection($screensFields, new ScreenFieldsTransformer);

            $data = $fractal->createData($screensFieldsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
	}



	public function saveScreenFields()
	{
		 
		try {

			$allscreensFields = Input::all();

			$screensFieldsArray = $allscreensFields['data'];

			$screensFields = $screensFieldsArray['screenFields'];

			foreach($screensFields as $key => $value)
			{
			    $screenField = ScreenFields::find($value['id']);
			    $screenField->field_value = $value['description'];
			    $screenField->save();
			}
		} catch (Exception $e) {
			return $this->setStatusCode(500)->respondWithError($e);
		}

		$successResponse = [
			'status' => true,
			'message' => 'Screen Fields saved successfully!',
		];

		return $this->setStatusCode(200)->respond($successResponse);
	}


	

}