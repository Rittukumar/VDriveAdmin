<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class StoreFrontController extends AppController
{

    /**
     * Display a listing of the resource.
     * GET /storefront
     *
     * @param $storeId
     * @return Response
     */
    public function getStoreComments($storeId)
    {
        try {

            $paginator = StoreComment::with('comment', 'commenter.profile.profile_image')
                ->where('store_id', $storeId)->orderBy('created_at', 'DESC')->paginate(10);

            $allComments = $paginator->getCollection();

            if (!$allComments) {
                return $this->responseNotFound('Comments not found!');
            }

            $fractal = new Manager();

            $storeCommentsResource = new Collection($allComments, new StoreCommentTransformer());

            $storeCommentsResource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            $data = $fractal->createData($storeCommentsResource);

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
    public function addStoreComment()
    {
        try {
            $input_array = Input::all();

            $storeId = (int)$input_array['store_id'];
            $userId = (int)$input_array['user_id'];

            $comment = Comment::create([
                'comment' => $input_array['comment']
            ]);

            $storeComment = StoreComment::create([
                'store_id' => $storeId,
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
    public function updateStoreComment()
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
    public function deleteStoreComment()
    {
        try {
            $input_array = Input::all();

            $storeCommentId = (int)$input_array['id'];

            $storeComment = StoreComment::find($storeCommentId);

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
            $storeId = $inputs_array['store_id'];
            $scale = $inputs_array['grade'];

            $storeGrade = StoreGrade::where('grader_id', $graderId)
                ->where('store_id', $storeId)
                ->first();

            $grade = null;

            if (!$storeGrade) {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                StoreGrade::Create([
                    'grader_id' => $graderId,
                    'store_id' => $storeId,
                    'grade_id' => $grade->id,
                ]);
            } else {
                $grade = Grade::find($storeGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = StoreGrade::join('grades', 'store_front_grades.grade_id', '=', 'grades.id')
                ->where('store_front_grades.store_id', $storeId)
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
    public function getStoreGrades($storeId, $userId)
    {
        try {
            $storeGrades = StoreGrade::with('grade', 'grader')->where('store_id', $storeId)->get();

            if (!$storeGrades) {
                return $this->responseNotFound('Store grades not found!');
            }

            $storeGradesData['grades'] = $storeGrades;

            // Calculate the average grade
            $avgGrade = round(StoreGrade::join('grades', 'store_front_grades.grade_id', '=', 'grades.id')
                ->where('store_front_grades.store_id', $storeId)->avg('scale'), 1);

            $storeGradesData['avg_grade'] = $avgGrade;

            // Find the user grade for the store.
            $userGrade = StoreGrade::with('grade')->where('grader_id', $userId)
                ->where('store_id', $storeId)->first();

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
    public function createStoreStream() {
        try {
            $inputs_array = Input::all();

            $storeId = $inputs_array['store_id'];
            $userId = $inputs_array['user_id'];

            try {
                $store = Store::with('collage_image1', 'collage_image2', 'collage_image3')->find($storeId);

                try {
                    $rewoicePost = Post::create([
                        'title' => $store['title'],
                        'owner_id' => $userId,
                        'description' => $store['description'],
                        'visibility_id' => 1,
                        'post_type_id' => 0,
                    ]);

                    if ($store['collage_image1']) {
                        $image1 = $store['collage_image1'];

                        PostImage::create([
                            'image_id' => $image1->id,
                            'post_id' => $rewoicePost->id
                        ]);
                    }

                    if ($store['collage_image2']) {
                        $image2 = $store['collage_image2'];

                        PostImage::create([
                            'image_id' => $image2->id,
                            'post_id' => $rewoicePost->id
                        ]);
                    }

                    if ($store['collage_image3']) {
                        $image3 = $store['collage_image3'];

                        PostImage::create([
                            'image_id' => $image3->id,
                            'post_id' => $rewoicePost->id
                        ]);
                    }

                    // Create link for the store
                    $link = Link::create([
                        'url_link' => '#/store/' . $storeId
                    ]);

                    PostLink::create([
                        'link_id' => $link->id,
                        'post_id' => $rewoicePost->id
                    ]);

                    StoreStream::create([
                        'post_id' => $rewoicePost->id,
                        'user_id' => $userId,
                        'store_id' => $storeId,
                    ]);

                } catch(Exception $ex) {
                    return $ex;
                }

                $resharesCount = count(StoreStream::where('store_id', $storeId)->get());

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
     * @param $storeId
     * @return mixed
     */
    public function getStoreRestreams($storeId)
    {
        try {
            $storeRestreams = StoreStream::where('store_id', $storeId)->count();

            return $storeRestreams;

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

}