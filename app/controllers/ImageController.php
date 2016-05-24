<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;

class ImageController extends AppController
{

    // Method to upload image
    /**
     * @return mixed
     */
    public function uploadImage()
    {
        try {
            if (Input::hasFile('image')) {
                $image = Input::file('image');

                $extension = $image->getClientOriginalExtension();


                $filename = date('Y-m-d-H:i:s') . "-" . $image->getClientOriginalName();

                $filename = str_replace(":","_",$filename);

                $imagePath = public_path() . '/images/' . $filename;

                $imageConfig = Config::get('app.images.sizes.large');

                try {
                    $responseImg = Image::make($image->getRealPath())->save($imagePath);
                } catch (Exception $ex) {
                    return $this->setStatusCode(500)->respondWithError($ex);
                }

                $successResponse = [
                    'status' => true,
                    'message' => 'Image uploaded successfully!',
                    'imageName' => $responseImg->filename . '.' . $extension,
                    'imagePath' => URL::to('/images/' . $responseImg->filename) . '.' . $extension
                ];

                return $this->setStatusCode(200)->respond($successResponse);
            } else {
                return $this->setStatusCode(404)->respondWithError("Image does not exist or is not in the right format!");
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }

    }

    /**
     * Crop image method
     * @return mixed
     */
    public function cropImage()
    {
        try {
//			if (Input::hasFile('image')) {

            $base64Image = Input::get('image');

            $width = Input::get('width');
            $height = Input::get('height');
            $x = Input::get('x');
            $y = Input::get('y');

            $extn = '.jpg';
            $filename = date('Y-m-d-H:i:s') . $extn;

            $filename = str_replace(":","_",$filename);

            $imagePath = public_path() . '/images/' . $filename;

            try {
                $image = base64_decode($base64Image);

                $responseImg = Image::make($image)
								->crop((int) $width, (int) $height, (int) $x, (int) $y)
                                ->save($imagePath);
            } catch (Exception $ex) {
                return $this->setStatusCode(500)->respondWithError($ex);
            }

            $successResponse = [
                'status' => true,
                'message' => 'Image cropped successfully!',
                'imageName' => $responseImg->filename . $extn,
                'imagePath' => URL::to('/images/' . $responseImg->filename . $extn)
            ];

            return $this->setStatusCode(200)->respond($successResponse);
//			}
//			else
//			{
//				return $this->setStatusCode(404)->respondWithError("Image does not exist or is not in the right format!");
//			}

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @param $imageName
     * Get the original image
     * @return mixed
     */
    public function showImage($imageName)
    {
        try {
            $img = Image::cache(function ($image) use ($imageName) {

                $filepath = public_path() . '/images/' . $imageName;

                return $image->make($filepath);
            }, 10);

            return Response::make($img, 200, array('Content-Type' => 'image/jpeg'));
        } catch (NotReadableException $notReadEx) {
            $errorMessage = [
                'status' => false,
                'message' => 'Image is already deleted or not readable'
            ];
            return $this->setStatusCode(404)->respondWithError($errorMessage);
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => 'Error Occurred'
            ];
            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    public function showScaledImage($imageName, $width = 1280, $height = 960)
    {
        $cacheimage = Image::cache(function ($image) use ($imageName, $width, $height) {

            $filepath = public_path() . '/images/' . $imageName;

            return $image->make($filepath)->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        }, 10); // cache for 10 minutes

        return Response::make($cacheimage, 200, array('Content-Type' => 'image/jpeg'));
    }

}
