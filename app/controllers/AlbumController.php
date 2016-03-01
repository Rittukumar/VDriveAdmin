<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class AlbumController extends AppController {

	protected $albumTransformer;

	function __construct(AlbumTransformer $albumTransformer)
	{
		$this->albumTransformer = $albumTransformer;
	}

	/**
	 * Display a listing of the resource.
	 * GET /albums
	 *
	 * @return Response
	 */
	public function index()
	{
		try{
			$limit = Input::get('limit') ?: 15;

			$albums = Album::with('images','grades','comments.profile.profile_image')->paginate($limit);

			if(! $albums)
			{
				return $this->responseNotFound('Albums Not Found!');
			}

			$fractal = new Manager();

			$albumsResource = new Collection($albums, new AlbumTransformer());

			$albumsResource->setPaginator(new IlluminatePaginatorAdapter($albums));

			$data = $fractal->createData($albumsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Display a listing of the resource.
	 * GET /albums
	 *
	 * @return Response
	 */
	public function getMyAlbums($user_id)
	{
		try{
			$limit = Input::get('limit') ?: 15;

			$albums = Album::with('images.comments', 'images.grades','comments.profile.profile_image','grades')->where('owner_id', $user_id)->paginate($limit);

			if(! $albums)
			{
				return $this->responseNotFound('Albums Not Found!');
			}

			$fractal = new Manager();

			$albumsResource = new Collection($albums, new AlbumTransformer());

			$albumsResource->setPaginator(new IlluminatePaginatorAdapter($albums));

			$data = $fractal->createData($albumsResource);

			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

    /**
     * @return mixed
     */
    public function addComment() {
        try
        {
            $input = Input::all();

            $input_array = $input['data'];

            $comment = $input_array['comment'];
            $album_id = $input_array['album_id'];
            $commenterId = $input_array['commeter_id'];

            // Insert the commment into comments table.
            $InsertedComment = Comment::create(
                [
                    'comment' => $comment
                ]);

            // Insert the comment reference to pivot album image comments table.
            $albumComment = AlbumComment::create([
                'comment_id' => $InsertedComment->id,
                'user_id' => $commenterId,
                'album_id' => $album_id
            ]);

            $successResponse = [
                'status' => true,
                'id' => $albumComment->id,
                'message' => 'Album comment created successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        }
        catch(Exception $e)
        {
            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @return mixed
     */
    public function addImageComment() {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $comment = $input_array['comment'];
            $albumImageId = $input_array['album_image_id'];
            $commenterId = $input_array['commeter_id'];

            // Insert the commment into comments table.
            $InsertedComment = Comment::create(
                [
                    'comment' => $comment
                ]);

            // Insert the comment reference to pivot album image comments table.

            $albumImageComment = AlbumImageComment::create([
                'comment_id' => $InsertedComment->id,
                'commenter_id' => $commenterId,
                'album_image_id' => $albumImageId
            ]);

            $successResponse = [
                'status' => true,
                'id' => $albumImageComment->id,
                'message' => 'Album image comment created successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        }
        catch(Exception $e)
        {
            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * remove album comment
     * @return mixed
     */
    public function removeComment()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $commentId = $input_array['comment_id'];

            $createdComment = AlbumComment::where('comment_id', $commentId)->first();

            if(!$createdComment) {
                return $this->responseNotFound('Comment does not exist!');
            }

            $comment = Comment::find($commentId);

            $comment->delete();

            $createdComment->delete();

            $successResponse = [
                'status' => true,
                'message' => 'Album comment deleted successfully!'
            ];

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }
        return $this->setStatusCode(200)->respond($successResponse);

    }

    /**
     * remove blog comment
     * @return mixed
     */
    public function removeImageComment()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $commentId = $input_array['comment_id'];

            $createdComment = AlbumImageComment::where('comment_id', $commentId)->first();

            if(!$createdComment) {
                return $this->responseNotFound('Comment does not exist!');
            }

            $comment = Comment::find($commentId);

            $comment->delete();

            $createdComment->delete();

            $successResponse = [
                'status' => true,
                'message' => 'Image comment deleted successfully!'
            ];

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }
        return $this->setStatusCode(200)->respond($successResponse);

    }

    /**
     * Display the specified resource.
     * GET /album_image_grades/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function showGrade($album_image_id)
    {
        $avgGrade = AlbumImageGrade::join('grades', 'album_image_grades.grade_id', '=', 'grades.id')
            ->where('album_image_grades.album_image_id', $album_image_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }
    //showAlbumGrade
    public function showAlbumGrade($album_id)
    {
        $avgGrade = AlbumGrade::join('grades', 'album_grades.grade_id', '=', 'grades.id')
            ->where('album_grades.album_id', $album_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }

    /**
	 * Display a listing of the resource.
	 * GET /album
	 *
	 * @param $album_id
	 * @return Response
	 */
	public function showAlbum($album_id)
	{
		try{
			$album = Album::with('images.comments','images.comments.profile','images.comments.profile.profile_image','images.grades.grade','comments.profile.profile_image','grades')->find($album_id);

            $avgGrade = AlbumGrade::join('grades', 'album_grades.grade_id', '=', 'grades.id')
                ->where('album_grades.album_id', $album_id)
                ->avg('scale');

            $album->scale = number_format($avgGrade,1);

			if(! $album)
			{
				return $this->responseNotFound('Album Not Found!');
			}

			$fractal = new Manager();

			$albumResource = new Item($album, new AlbumTransformer());

			$data = $fractal->createData($albumResource);


			return $data->toJson();
		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /album
	 *
	 * @return Response
	 */
	public function store()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$userId = $input_array['user_id'];
			$title = $input_array['name'];
            $visibility_id = $input_array['visibility_id'];

			if(isset($input_array['description']))
			{
				$description = $input_array['description'];
			}
			else
			{
				$description = "";
			}

			$album = Album::create([
				'owner_id' => $userId,
				'name' => $title,
				'description' => $description,
                'visibility_id' => $visibility_id
			]);

			$successResponse = [
				'status' => true,
				'id' => $album->id,
				'message' => 'Album created successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Add a friend to circle
	 * POST /circles
	 *
	 * @return Response
	 */
	public function addImages()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$albumId = $input_array['album_id'];
			$images = $input_array['images'];

			foreach ($images as $imageName) {
				$image = EvezownImage::create([
						'large_image_url' => $imageName
					]
				);

				$albumImage = AlbumImage::create([
					'album_id' => $albumId,
					'image_id' => $image['id']
				]);
			}

			$successResponse = [
				'status' => true,
				'message' => 'Images added to album successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Remove images from album
	 * @return mixed
     */
	public function removeImages() {
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$albumId = $input_array['album_id'];
			$imageIds = $input_array['image_ids'];

			foreach ($imageIds as $imageId) {
				$albumImage = AlbumImage::where('album_id', $albumId)
					->where('image_id', $imageId)->first();

				$image = EvezownImage::find($imageId);

				$image->delete();

				$albumImage->delete();

				// TODO - delete image from server.
			}

			$successResponse = [
				'status' => true,
				'message' => 'Images removed from album successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		try{
			$input = Input::all();

			$input_array = $input['data'];

			$albumId = $input_array['album_id'];

			$album = Album::find($albumId);

			if(!$album)
			{
				return $this->responseNotFound('Album does not exist!');
			}

			if(isset($input_array['name']))
			{
				$name = $input_array['name'];

				$album->name = $name;
			}

			if(isset($input_array['description']))
			{
				$description = $input_array['description'];

				$album->description = $description;
			}

            //$visibility_id

            if(isset($input_array['visibility_id']))
            {
                $visibility_id = $input_array['visibility_id'];

                $album->visibility_id = $visibility_id;
            }
			// Update circle.
			$album->save();

			$successResponse = [
				'status' => true,
				'message' => 'Album updated successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /album/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($albumId)
	{
		try{

			$albumToDelete = Album::find($albumId);

			if(! $albumToDelete)
			{
				return $this->responseNotFound('Album does not exist!');
			}

			// Get all the images from the album.
			$albumImages = AlbumImage::where('album_id', $albumId)->get();

			if($albumImages != null)
			{
				foreach ($albumImages as $image) {
					$albumImage = AlbumImage::where('image_id', $image['image_id'])->first();

					$image = EvezownImage::find($image['image_id']);

					$image->delete();

					$albumImage->delete();

					// TODO - delete image from server.
				}
			}

			$albumToDelete->delete();

			$successResponse = [
				'status' => true,
				'message' => 'Album deleted successfully!'
			];

			return $this->setStatusCode(200)->respond($successResponse);

		} catch (Exception $e) {

			return $this->setStatusCode(500)->respondWithError($e);
		}
	}


    public function storeGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $album_image_id = $inputs_array['album_image_id'];
            $scale = $inputs_array['scale'];


            $albumGrade = AlbumImageGrade::where('grader_id', $ownerId)
                ->where('album_image_id', $album_image_id)
                ->first();

            $grade = null;

            if(! $albumGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                AlbumImageGrade::Create([
                    'grader_id' => $ownerId,
                    'album_image_id' => $album_image_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($albumGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = AlbumImageGrade::join('grades', 'album_image_grades.grade_id', '=', 'grades.id')
                ->where('album_image_grades.album_image_id', $album_image_id)
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


    public function storeAlbumGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $album_id = $inputs_array['album_id'];
            $scale = $inputs_array['scale'];


            $albumGrade = AlbumGrade::where('grader_id', $ownerId)
                ->where('album_id', $album_id)
                ->first();

            $grade = null;

            if(! $albumGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                AlbumGrade::Create([
                    'grader_id' => $ownerId,
                    'album_id' => $album_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($albumGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = AlbumGrade::join('grades', 'album_grades.grade_id', '=', 'grades.id')
                ->where('album_grades.album_id', $album_id)
                ->avg('scale');

            $successResponse = [
                'status' => true,
                'message' => 'Graded album successfully!',
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


}