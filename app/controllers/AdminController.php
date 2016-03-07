<?php

use Illuminate\Support\Facades\Mail;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class AdminController extends AppController
{
// edit and update user information
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

    public function savePersonalInfo()
    {
        try {

            $inputs = Input::all();

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


    /**
     * Display all the registered users and their status.
     * GET /user
     *
     * @param $admin_id
     * @return Response
     * @internal param $user_id
     */
    public function getUsers($admin_id)
    {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                return $this->setStatusCode(403)->respondWithError('User does not have permission!');
            }

            $limit = Input::get('limit') ?: 10;

            $users = User::paginate($limit);

            if (!$users) {
                return $this->responseNotFound('User Not Found!');
            }

            $fractal = new Manager();

            $usersResource = new Collection($users, new UserTransformer);

            $usersResource->setPaginator(new IlluminatePaginatorAdapter($users));

            $data = $fractal->createData($usersResource);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }

        return $data->toJson();
    }

    /**
     * Get all evezplace sections
     * @param $admin_id
     * @return mixed
     */
    public function getEvezplaceSections($admin_id) {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                return $this->setStatusCode(403)->respondWithError('User does not have permission!');
            }

            return  EvezownSection::where('id', '>', 2)->get();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

        /**
     * Display all the registered users and their status without limit(pagination).
     * GET /user
     *
     * @param $admin_id
     * @return Response
     * @internal param $user_id
     */
    public function getAllUsers($admin_id)
    {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                return $this->setStatusCode(403)->respondWithError('User does not have permission!');
            }

            $limit = Input::all();

            $users = User::paginate($limit);

            if (!$users) {
                return $this->responseNotFound('User Not Found!');
            }

            $fractal = new Manager();

            $usersResource = new Collection($users, new UserTransformer);

            $usersResource->setPaginator(new IlluminatePaginatorAdapter($users));

            $data = $fractal->createData($usersResource);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }

        return $data->toJson();
    }

    public function getInvites($admin_id)
    {
        try {

            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                return $this->setStatusCode(403)->respondWithError('User does not have permission!');
            }

            $limit = Input::get('limit') ?: 10;

            $invites = Invite::paginate($limit);

            if (!$invites) {
                return $this->responseNotFound('Invites Not Found!');
            }

            $fractal = new Manager();

            $invitesResource = new Collection($invites, new InviteTransformer);

            $invitesResource->setPaginator(new IlluminatePaginatorAdapter($invites));

            $data = $fractal->createData($invitesResource);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }

        return $data->toJson();
    }

    /**
     *Accept invite by admin
     * @param $admin_id
     * @param $invite_id
     * @return mixed
     */
    public function acceptInvite($admin_id, $invite_id)
    {
        $hasAdminRole = User::find($admin_id)->hasRole('Admin');

        if (!$hasAdminRole) {
            return $this->setStatusCode(403)->respondWithError('User does not have permission!');
        }

        $generatedCode = bin2hex(openssl_random_pseudo_bytes(16));

        $invite = Invite::find($invite_id);

        $invite->code = $generatedCode;

        if (!$invite->save()) {
            return $this->setStatusCode(422)->respondWithError('Accept invite failed!');
        }

        $user = array(
            'email' => $invite->email,
            'name' => $invite->email
        );

        $data = array(
            'name' => $user['name'],
            'inviteCode' => $invite->code
        );

        Mail::send('emails.register', $data, function ($message) use ($user) {
            $message->from('admin@evezown.com', 'Evezown Admin');
            $message->to($user['email'], $user['name'])->subject('Welcome to Evezown!');
        });

        $responseData = [
            'message' => 'Invite accepted successfully!',
            'status' => true
        ];

        return $this->setStatusCode(200)->respond($responseData);
    }

    public function sendMail()
    {
        $buyer = array(
            'email' => 'radhakrishnan.radha@gmail.com',
            'phone' => '9845982178'
        );

        $transactionCode = 'XD234D';

        $order = Order::with('buyer', 'orderItems.productSku.ProductImages.image',
            'orderItems.productSku.product')->find(80);

        $data = array(
            'buyerEmail' => $buyer['email'],
            'buyerPhone' => $buyer['phone'],
            'transactionCode' => $transactionCode,
            'order' => $order
        );

//        Mail::send('emails.customerorder', $data, function ($message) use ($buyer) {
//            $message->from('editor@evezown.com', 'Evezown Admin');
//            $message->to($buyer['email'], $buyer['email'])->subject('Your order placed!');
//        });

        $store = array(
            'email' => 'radhakrishnan.radha@gmail.com'
        );

        Mail::send('emails.store-order', $data, function ($message) use ($store) {
            $message->from('editor@evezown.com', 'Evezown Admin');
            $message->to($store['email'], $store['email'])->subject('You received an order!');
        });


        return $this->setStatusCode(200)->respond("Mail Sent");
    }

    /**
     *Accept invite by admin
     */
    public function rejectInvite($admin_id, $invite_id)
    {
        $hasAdminRole = User::find($admin_id)->hasRole('Admin');

        if (!$hasAdminRole) {
            return $this->setStatusCode(403)->respondWithError('User does not have permission!');
        }

        $invite = Invite::find($invite_id);

        if (!$invite->delete()) {
            return $this->setStatusCode(422)->respondWithError('Reject invite failed!');
        }

        $responseData = [
            'message' => 'Invite rejected successfully!',
            'status' => true
        ];

        return $this->setStatusCode(200)->respond($responseData);
    }

    public function getBrandsForAdmin($user_id)
    {
        try {
            //return $user_id;
            $hasAdminRole = User::find($user_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }


            try {
                $brand = Brand::all();
            } catch (Exception $e) {
                return $e;
            }


            $fractal = new Manager();

            $brandsResource = new Collection($brand, new BrandTransformer());

            return $fractal->createData($brandsResource)->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    public function addBrand($user_id)
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

            $input = Input::all();

            $inputs_array = $input['data'];

            $brandTitle = $inputs_array['title'];

            $subCatId = $inputs_array['subCatId'];

            $brandImageName = $inputs_array['image_name'];

            Brand::create([
                'title' => $brandTitle,
                'image_name' => $brandImageName,
                'sub_cat_id' => $subCatId
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'Brand added successfully!'
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


    public function getPostForAdmin($user_id)
    {
        try {
            // $limit = 15;

            $hasAdminRole = User::find($user_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            // Query to fetch all posts based on visibility settings. Post with images and
            // user data.
            $posts = Post::with('images', 'links', 'post_location',
                'user.profile_image',
                'brand', 'comments.user.profile_image', 'grades.user')
                ->where('visibility_id', '<>', 4)
                ->orderBySubmitDate()->get();

            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(403)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Collection($posts, new PostsTransformer);

            // $postsResource->setPaginator(new IlluminatePaginatorAdapter($posts));

            $data = $fractal->createData($postsResource);

            return $data->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

//    $scope.DeleteGroup = function(group)
//    {
//        $http.get($scope.service_url + 'users/groups/'+group.id+'/delete').
//            success(function (data, status, headers, config)
//            {
//                toastr.success(data.message, 'Groups');
//            }).error(function (data)
//            {
//                toastr.error(data.error.message, 'Groups');
//            }).then(function()
//            {
//                $location.path('/groups');
//                $scope.GetAllGroups();
//                $scope.GetMyGroups();
//            });
//    }
//
//$scope.EditGroup = function()
//    {
//        ngDialog.open({ template: 'EdittemplateId' });
//    }
//
//$scope.UpdateGroup= function(selectedGroup)
//    {
//        $http.post($scope.service_url + 'users/groups/update'
//            , {
//                data:
//                {
//                    title: selectedGroup.title,
//                    description:selectedGroup.description,
//                    user_id:$cookieStore.get('userId'),
//                    visibility_id: $scope.selectedVisibility.id,
//                    group_id : selectedGroup.id
//                },
//                headers: {'Content-Type': 'application/json'}
//            }).
//            success(function (data, status, headers, config)
//            {
//                ngDialog.close();
//                toastr.success(data.message, 'Groups');
//
//            }).error(function (data)
//            {
//                toastr.error(data.error.message, 'Groups');
//            }).then(function()
//            {
//                $scope.GetAllGroups();
//                $scope.GetMyGroups();
//            });
//    }




    /**
     * Get all news items
     * @param $admin_id
     * @return mixed
     */
    public function getNews($admin_id)
    {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $news = News::orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($news, new NewsTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get all news items
     * @param $admin_id
     * @return mixed
     */
    public function getHomeNews()
    {
        try {

            $news = News::where('priority', 1)->orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($news, new NewsTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get all article items
     * @param $admin_id
     * @return mixed
     */
    public function getArticles($admin_id)
    {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $articles = Article::orderBy('updated_at', 'Desc')->get();;

            $fractal = new Manager();

            $postsResource = new Collection($articles, new ArticleTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get all article items
     * @param $admin_id
     * @return mixed
     */
    public function getHomeArticles()
    {
        try {

            $articles = Article::where('priority', 1)->orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($articles, new ArticleTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get all article items
     * @param $admin_id
     * @return mixed
     */
    public function getInterviews($admin_id)
    {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $interviews = Interview::orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($interviews, new InterviewTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get home interviews method
     * @return mixed|string
     * @internal param $admin_id
     */
    public function getHomeInterviews()
    {
        try {
            $interviews = Interview::where('priority', 1)->orderBy('created_at', 'description')->get();

            $fractal = new Manager();

            $postsResource = new Collection($interviews, new InterviewTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get all videos method
     * @param $admin_id
     * @return mixed|string
     */
    public function getVideos($admin_id)
    {
        try {
            $hasAdminRole = User::find($admin_id)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $videos = Video::orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($videos, new VideoTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * Get all videos method
     * @param $admin_id
     * @return mixed|string
     */
    public function getTopVideos()
    {
        try {
            $videos = Video::where('priority', 1)->take(4)->orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($videos, new VideoTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * @return mixed|string
     */
    public function getMoreVideos()
    {
        try {
            $videos = Video::where('priority', 1)->orderBy('updated_at', 'Desc')->get();

            $fractal = new Manager();

            $postsResource = new Collection($videos, new VideoTransformer);

            $data = $fractal->createData($postsResource);

            return $data->toJson();

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }


    /**
     * Create News method.
     * @param $user_id
     * @return mixed
     */
    public function createNews($user_id)
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


            $newsTitle = $inputs_array['title'];

            $newsDescription = $inputs_array['description'];

            $newsLink = $inputs_array['link'];


            if(isset($inputs_array['priority']))
                $newsPriority = $inputs_array['priority'];
            else
                $newsPriority = 0;

            News::create([
                'title' => $newsTitle,
                'description' => $newsDescription,
                'link' => $newsLink,
                'priority' => $newsPriority
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'News added successfully!'
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
     * Update news item method
     * @param $user_id
     * @return mixed
     */
    public function updateNews($user_id)
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

            $newsId = $inputs_array['id'];

            $newsTitle = $inputs_array['title'];

            $newsDescription = $inputs_array['description'];

            $newsLink = $inputs_array['link'];

            $newsPriority = $inputs_array['priority'];

            $news = News::find($newsId);

            if (!$news) {
                $errorMessage = [
                    'status' => false,
                    'message' => "News item does not exist"
                ];

                return $this->setStatusCode(404)->respond($errorMessage);
            }

            $news->title = $newsTitle;
            $news->description = $newsDescription;
            $news->link = $newsLink;
            $news->priority = $newsPriority;

            $news->save();

            $successResponse = [
                'status' => true,
                'message' => 'News updated successfully!'
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
     * Update article item method
     * @param $user_id
     * @return mixed
     */
    public function updateArticle($user_id)
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

            $id = $inputs_array['id'];

            $title = $inputs_array['title'];

            $description = $inputs_array['description'];

            $link = $inputs_array['link'];

            $priority = $inputs_array['priority'];

            $article = Article::find($id);

            if (!$article) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Article does not exist"
                ];

                return $this->setStatusCode(404)->respond($errorMessage);
            }

            $article->title = $title;
            $article->description = $description;
            $article->link = $link;
            $article->priority = $priority;

            $article->save();

            $successResponse = [
                'status' => true,
                'message' => 'Article updated successfully!'
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
     * Update article item method
     * @param $user_id
     * @return mixed
     */
    public function updateInterview($user_id)
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

            $id = $inputs_array['id'];

            $title = $inputs_array['title'];

            $description = $inputs_array['description'];

            $link = $inputs_array['link'];

            $priority = $inputs_array['priority'];

            $interview = Interview::find($id);

            if (!$interview) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Interview does not exist"
                ];

                return $this->setStatusCode(404)->respond($errorMessage);
            }

            $interview->title = $title;
            $interview->description = $description;
            $interview->link = $link;
            $interview->priority = $priority;

            $interview->save();

            $successResponse = [
                'status' => true,
                'message' => 'Interview updated successfully!'
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
     * Update video method
     * @param $user_id
     * @return mixed
     */
    public function updateVideo($user_id)
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

            $id = $inputs_array['id'];

            $title = $inputs_array['title'];

            $link = $inputs_array['link'];

            $priority = $inputs_array['priority'];

            $video = Video::find($id);

            if (!$video) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Video does not exist"
                ];

                return $this->setStatusCode(404)->respond($errorMessage);
            }

            $video->title = $title;
            $video->link = $link;
            $video->priority = $priority;

            $video->save();

            $successResponse = [
                'status' => true,
                'message' => 'Video updated successfully!'
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
     * Delete news item
     * @return mixed
     */
    public function deleteNews() {
        try {

            $inputs_array = Input::all();

            $userId = $inputs_array['user_id'];

            $hasAdminRole = User::find($userId)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $newsId = $inputs_array['news_id'];

            News::destroy($newsId);

            $successResponse = [
                'status' => true,
                'message' => 'News item deleted successfully!'
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
     * Action performed on users. The user can be blocked, unblocked, activated or deleted.
     * @return 
     */
    public function userAction($admin_id) {
    	try {
    
    		$inputs = Input::all();
    		$inputs_array = $inputs['data'];
    
    		$hasAdminRole = User::find($admin_id)->hasRole('Admin');
    		if (!$hasAdminRole) {
    			$errorMessage = [
    			'status' => false,
    			'message' => "Unauthorized User"
    					];
    			return $this->setStatusCode(403)->respond($errorMessage);
    		}
    		$userId = $inputs_array['user_id'];
		    $action_item = $inputs_array['action_item'];
		    $action = $inputs_array['action'];
    
    		$user = User::where('id', $userId)->first();
    		if($action == "deleted" || $action == "activated" ){
    			$user->deleted = $action_item;   
    		}else {
    			$user->blocked = $action_item;
    		}
    		$user->save();
    
    		$successResponse = [
					    		'status' => true,
					    		'message' => 'User '.$action.' successfully!'
    						   ];
    		return $this->setStatusCode(200)->respond($successResponse);
    	} catch (Exception $e) {
    		return $this->setStatusCode(500)->respondWithError("The action performed on this user failed");
    	}
    }
    
    
    /**
     * Delete news item
     * @return mixed
     */
    public function deleteArticle() {
        try {

            $inputs_array = Input::all();

            $userId = $inputs_array['user_id'];

            $hasAdminRole = User::find($userId)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $articleId = $inputs_array['article_id'];

            Article::destroy($articleId);

            $successResponse = [
                'status' => true,
                'message' => 'Article deleted successfully!'
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
     * Delete interview item method
     * @return mixed
     */
    public function deleteInterview() {
        try {

            $inputs_array = Input::all();

            $userId = $inputs_array['user_id'];

            $hasAdminRole = User::find($userId)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $interviewId = $inputs_array['interview_id'];

            Interview::destroy($interviewId);

            $successResponse = [
                'status' => true,
                'message' => 'Interview deleted successfully!'
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
     * Delete video method
     * @return mixed
     */
    public function deleteVideo() {
        try {
            $inputs_array = Input::all();

            $userId = $inputs_array['user_id'];

            $hasAdminRole = User::find($userId)->hasRole('Admin');

            if (!$hasAdminRole) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Unauthorized User"
                ];

                return $this->setStatusCode(403)->respond($errorMessage);
            }

            $videoId = $inputs_array['video_id'];

            Video::destroy($videoId);

            $successResponse = [
                'status' => true,
                'message' => 'Video deleted successfully!'
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
     * Create Article
     * @param $user_id
     * @return mixed
     */
    public function createArticle($user_id)
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

            $articleTitle = $inputs_array['title'];

            $articleDescription = $inputs_array['description'];

            $articleLink = $inputs_array['link'];


            if(isset($inputs_array['priority']))
                $articlePriority = $inputs_array['priority'];
            else
                $articlePriority = 0;

            Article::create([
                'title' => $articleTitle,
                'description' => $articleDescription,
                'link' => $articleLink,
                'priority' => $articlePriority
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'Article added successfully!'
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
     * Interview add
     * @param $user_id
     * @return mixed
     */
    public function createInterview($user_id)
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

            $interviewTitle = $inputs_array['title'];

            $interviewDescription = $inputs_array['description'];

            $interviewLink = $inputs_array['link'];

            if(isset($inputs_array['priority']))
                $interviewPriority = $inputs_array['priority'];
            else
                $interviewPriority = 0;

            Interview::create([
                'title' => $interviewTitle,
                'description' => $interviewDescription,
                'link' => $interviewLink,
                'priority' => $interviewPriority
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'Interview added successfully!'
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
     * Create Video method
     * @param $user_id
     * @return mixed
     */
    public function createVideo($user_id)
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

            $title = $inputs_array['title'];

            $link = $inputs_array['link'];

            if(isset($inputs_array['priority']))
                $priority = $inputs_array['priority'];
            else
                $priority = 0;

            Video::create([
                'title' => $title,
                'link' => $link,
                'priority' => $priority
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'Video added successfully!'
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
}