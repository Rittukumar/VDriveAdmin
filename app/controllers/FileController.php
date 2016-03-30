<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Exception\NotReadableException;
use Intervention\Image\Facades\Image;

class FileController extends AppController
{

    // Method to upload image
    /**
     * @return mixed
     */
    public function uploadFile()
    {
        try {
            if (Input::hasFile('files')) {
                $file = Input::file('files');

                $extension = $file->getClientOriginalExtension();

                $filename = date('Y-m-d-H:i:s') . "-" . $file->getClientOriginalName();
                
                $filename = str_replace(":","_",$filename);

                $filePath = public_path() . '/files';

                $file->move($filePath, $filename);

                $successResponse = [
                    'status' => true,
                    'message' => 'File uploaded successfully!',
                    'imageName' => $filename,
                    'imagePath' => URL::to('/files/' . $filename)
                ];

                return $this->setStatusCode(200)->respond($successResponse);
            } else {
                return $this->setStatusCode(404)->respondWithError("file does not exist!");
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }

    }
}
