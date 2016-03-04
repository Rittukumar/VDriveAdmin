<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class BlogController extends AppController
{

    protected $blogTransformer;

    function __construct(BlogTransformer $blogTransformer)
    {
        $this->blogTransformer = $blogTransformer;
    }

    /**
     * @return mixed|string
     */
    public function blogs() {
        try {
            $limit = Input::get('limit') ?: 15;

            $blogs = Blog::with('author.profile_image', 
                'subcategory.category', 'comments.profile.profile_image',
                'blog_image', 'trending')->where('status', 'published')
            ->orderBySubmitDate()->paginate($limit);

            if (!$blogs) {
                return $this->responseNotFound('No blogs created by author!');
            }

            $fractal = new Manager();

            $blogsResource = new Collection($blogs, new BlogTransformer());

            $blogsResource->setPaginator(new IlluminatePaginatorAdapter($blogs));

            $data = $fractal->createData($blogsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Display a listing of the resource.
     * GET /blog
     *
     * @return Response
     */
    public function index($user_id)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $blogs = Blog::with('author.profile_image', 'subcategory.category',
                'comments.profile.profile_image','blog_image')
                ->where('author_id', $user_id)->paginate($limit);

            if (!$blogs) {
                return $this->responseNotFound('No blogs created by author!');
            }

            $fractal = new Manager();

            $blogsResource = new Collection($blogs, new BlogTransformer());

            $blogsResource->setPaginator(new IlluminatePaginatorAdapter($blogs));

            $data = $fractal->createData($blogsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getCoverPic($blogId)
    {
        try {
            $coverImagePointer = BlogImage::where('blog_id', $blogId)->first();

            if(! $coverImagePointer)
            {
                // For beta site
//                 return "2015-02-17-04:36:11-eve-avatar.png";
                // for test site.

                return "NoCoverImage";
            }
            else
            {
                if ($coverImagePointer->image_id != 0)
                {
                    $coverImage = EvezownImage::where('id', $coverImagePointer->image_id)->orderBy('created_at', 'DESC')->first();
                    return $coverImage->large_image_url;
                }
                else
                {
                    return "NoCoverImage";
                }
            }

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError('Error occured!');
        }
    }

    public function updateBlogPhoto() {
        try{
            $input = Input::all();

            $input_array = $input['data'];

            $blogId = $input_array['blog_id'];
            $imageName = $input_array['image_name'];

            $image = EvezownImage::create([
                    'large_image_url' => $imageName
                ]
            );


            $blogImage = BlogImage::firstOrCreate(array('blog_id' => $blogId));

            $blogImage->image_id = $image->id;
            $blogImage->save();

            $successResponse = [
                'status' => true,
                'message' => 'Images updated for blog successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function show($blogId)
    {
        try
        {
            $blog = Blog::with('author.profile_image', 'subcategory.category',
                        'comments.profile.profile_image', 'trending')->find($blogId);

            if (!$blog) {
                $errorMessage = [
                    'status' => false,
                    'message' => "blog does not exist!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

        $avgGrade = BlogGrade::join('grades', 'blog_grades.grade_id', '=', 'grades.id')
            ->where('blog_grades.blog_id', $blogId)
            ->avg('scale');

            $blog->scale = number_format($avgGrade,1);

            $fractal = new Manager();

            $blogResource = new Item($blog, new BlogTransformer());


            $data = $fractal->createData($blogResource);

            return $data->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /blog
     *
     * @return Response
     */
    public function store()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $userId = $input_array['author_id'];
            $title = $input_array['title'];
            $content = $input_array['content'];
            $subCatId = $input_array['sub_cat_id'];
            $visibility_id = $input_array['visibility_id'];

            $blog = Blog::create([
                'author_id' => $userId,
                'title' => $title,
                'sub_cat_id' => $subCatId,
                'visibility_id' => $visibility_id,
                'status' => 'draft'
            ]);

            $blog->content = $content;

            $blog->save();

            $successResponse = [
                'status' => true,
                'id' => $blog->id,
                'message' => 'Blog created successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Add blog comment
     * @return mixed
     */
    public function addComment()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $blogId = $input_array['blog_id'];
            $userId = $input_array['user_id'];
            $comment = $input_array['comment'];

            $createdComment = Comment::create([
                'comment' => $comment
            ]);

            $commentId = $createdComment->id;

            $blogComment = BlogComments::create([
                'user_id' => $userId,
                'blog_id' => $blogId
            ]);

            $blogComment->comment_id = $commentId;

            $blogComment->save();

            $successResponse = [
                'status' => true,
                'id' => $blogComment->id,
                'message' => 'Blog comment added successfully!'
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
    public function removeComment()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $commentId = $input_array['comment_id'];

            $createdComment = BlogComments::where('comment_id', $commentId)->first();

            if(!$createdComment) {
                return $this->responseNotFound('Comment does not exist!');
            }

            $comment = Comment::find($commentId);

            $comment->delete();

            $createdComment->delete();

            $successResponse = [
                'status' => true,
                'message' => 'Blog comment deleted successfully!'
            ];

        } catch (Exception $e) {
            return $this->setStatusCode(500)->respondWithError($e);
        }
        return $this->setStatusCode(200)->respond($successResponse);

    }

    /**
     * Update the specified resource in storage.
     * PUT /blog/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];

            $blogId = $input_array['blog_id'];

            $blog = Blog::find($blogId);

            if (isset($input_array['title'])) {
                $title = $input_array['title'];
                $blog->title = $title;
            }

            if (isset($input_array['visibility_id'])) {
                $visibility_id = $input_array['visibility_id'];
                $blog->visibility_id = $visibility_id;
            }

            if (isset($input_array['content'])) {
                $content = $input_array['content'];

                $blog->content = $content;
            }

            try{

                if (isset($input_array['sub_cat_id'])) 
                {
                    $blog->sub_cat_id = $input_array['sub_cat_id'];
                }

            }catch(Exception $ex)
            {
                return $ex;
            }


            $blog->save();
            $successResponse = [
                'status' => true,
                'id' => $blog->id,
                'message' => 'Blog updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Publish blog
     * @return mixed
     */
    public function publishBlog($blogId)
    {
        try {
            $blog = Blog::find($blogId);

            if(!$blog) {
                return $this->responseNotFound('Blog does not exist!');
            }

            $blog->status = 'published';

            $blog->save();

            $successResponse = [
                'status' => true,
                'message' => 'Blog published successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function EditAsDraft($blogId)
    {
        try {
            $blog = Blog::find($blogId);

            if(!$blog) {
                return $this->responseNotFound('Blog does not exist!');
            }

            $blog->status = 'draft';

            $blog->save();

            $successResponse = [
                'status' => true,
                'message' => 'Blog drafted successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function storeBlogGrade()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $ownerId = $inputs_array['owner_id'];
            $blog_id = $inputs_array['blog_id'];
            $scale = $inputs_array['scale'];


            $blogGrade = BlogGrade::where('grader_id', $ownerId)
                ->where('blog_id', $blog_id)
                ->first();

            $grade = null;

            if(! $blogGrade)
            {
                $grade = Grade::Create([
                    'scale' => $scale,
                ]);

                BlogGrade::Create([
                    'grader_id' => $ownerId,
                    'blog_id' => $blog_id,
                    'grade_id' => $grade->id,
                ]);
            }
            else
            {
                $grade = Grade::find($blogGrade->grade_id);

                $grade->scale = $scale;

                $grade->save();
            }

            $avgGrade = BlogGrade::join('grades', 'blog_grades.grade_id', '=', 'grades.id')
                ->where('blog_grades.blog_id', $blog_id)
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
     * GET /album_image_grades/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function showGrade($blog_id)
    {
        $avgGrade = BlogGrade::join('grades', 'blog_grades.grade_id', '=', 'grades.id')
            ->where('blog_grades.blog_id', $blog_id)
            ->avg('scale');

        return number_format($avgGrade,1);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /blog/{id}
     *
     * @param $blogId
     * @return Response
     * @internal param int $id
     */
    public function destroy($blogId)
    {
        try {
            $blog = Blog::find($blogId);

            if(!$blog) {
                return $this->responseNotFound('Blog does not exist!');
            }

            $blogComments = BlogComments::where('blog_id')->get();

            if ($blogComments) {
                foreach ($blogComments as $blogComment) {
                    $comment = Comment::find($blogComment->comment_id);

                    $comment->delete();

                    $blogComment->delete();
                }
            }

            $blog->delete();

            $successResponse = [
                'status' => true,
                'message' => 'Blog deleted successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

}