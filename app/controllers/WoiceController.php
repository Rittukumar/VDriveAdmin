<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class WoiceController extends AppController
{
    /**
     * @param $section_id
     * @return mixed
     */
    public function getCategories($section_id)
    {
        try {
            $categories = Category::with('subcategories', 'section')->where('section_id', $section_id)->get();

            if (!$categories) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Categories not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $categoriesResource = new Collection($categories, new CategoryTransformer());

            return $fractal->createData($categoriesResource)->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }


    public function getAllCategories()
    {
        try {
            $categories = Category::with('subcategories', 'section')->where('section_id', 3)->orWhere('section_id', 4)->orWhere('section_id', 5)->orWhere('section_id', 6)->get();

            if (!$categories) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Categories not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $categoriesResource = new Collection($categories, new CategoryTransformer());

            return $fractal->createData($categoriesResource)->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * @param $section_id
     * @return mixed
     */
    public function getCategoriesById($catId)
    {
        try {
            $categories = Category::with('subcategories', 'section')->where('id', $catId)->get();

            if (!$categories) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Categories not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $categoriesResource = new Collection($categories, new CategoryTransformer());

            return $fractal->createData($categoriesResource)->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * @param $categoryId
     * @return mixed|string
     */
    public function getSubcategoryById($subCategoryId)
    {
        try {
            $subCategories = SubCategory::with('category')->where('id', '=', $subCategoryId)->get();

            if (!$subCategories) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Sub Categories not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $subcategoriesResource = new Collection($subCategories, new SubcategoryTransformer());

            return $fractal->createData($subcategoriesResource)->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }

    /**
     * @param $categoryId
     * @return mixed|string
     */
    public function getSubcategories($categoryId)
    {
        try {
            $subCategories = SubCategory::with('category')->where('category_id', '=', $categoryId)->get();

            if (!$subCategories) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Sub Categories not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $subcategoriesResource = new Collection($subCategories, new SubcategoryTransformer());

            return $fractal->createData($subcategoriesResource)->toJson();
        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }


    /**
     * @param $user_id
     * @return mixed|string
     */
    public function getPosts($user_id)
    {
        try {
            $limit = 15;

            $posts = Post::with('images', 'post_location', 'links', 'user.profile_image',
                                'brand', 'comments.user.profile_image', 'grades.user')
                ->where('visibility_id', 1)
                ->orWhereExists(function ($query) use ($user_id) {
                    $query->where('visibility_id', 2);
                    $query->select(DB::raw(1))
                        ->from('circle_friends')
                        ->whereRaw('circle_friends.friend_user_id = ' . $user_id)
                        ->whereExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('circles')
                                ->whereRaw('circles.id = circle_friends.circle_id')
                                ->whereRaw('circles.user_id = posts.owner_id');
                        });
                })
                ->orWhereExists(function ($query) use ($user_id) {
                    $query->where('visibility_id', 3);
                    $query->select(DB::raw(1))
                        ->from('friends')
                        ->whereRaw('friends.user_id = posts.owner_id')
                        ->whereRaw('friends.friend_user_id = ' . $user_id);
                })
                ->orWhere(function ($query) use ($user_id) {
                    $query->where('visibility_id', 4);
                    $query->where('owner_id', $user_id);
                })
                ->orderBySubmitDate()->paginate($limit);

            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Collection($posts, new PostsTransformer);

            $postsResource->setPaginator(new IlluminatePaginatorAdapter($posts));

            $data = $fractal->createData($postsResource);

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
     * @param $user_id
     * @return mixed|string
     */
    public function getPost($post_id)
    {
        try {

            $post = Post::with('images', 'links', 'post_location', 'user.profile_image', 'brand', 'comments.user.profile_image', 'grades.user')
                ->where('id', $post_id)->first();

            if (!$post) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Post not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Item($post, new PostsTransformer);

            $data = $fractal->createData($postsResource);

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
     * @param brans
     * @param $post_type_id
     * @return mixed|string
     * @internal param $post_type
     */
    public function getPostsByType($user_id, $type)
    {
        try {
            $limit = 15;


            // Query to fetch all posts based on visibility settings. Post with images and
            // user data.
            $posts = Post::with('images', 'links', 'post_location', 'user.profile_image', 'brand',
                                'comments.user.profile_image', 'grades.user')
                ->orWhere(function ($query) use ($type) {
                    $query->where('visibility_id', 1);
                    $query->where('post_type_id', $type);
                })
                ->orWhereExists(function ($query) use ($user_id, $type) {
                    $query->where('visibility_id', 2);
                    $query->where('post_type_id', $type);
                    $query->select(DB::raw(1))
                        ->from('circle_friends')
                        ->whereRaw('circle_friends.friend_user_id = ' . $user_id)
                        ->whereExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('circles')
                                ->whereRaw('circles.id = circle_friends.circle_id')
                                ->whereRaw('circles.user_id = posts.owner_id');
                        });
                })
                ->orWhereExists(function ($query) use ($user_id, $type) {
                    $query->where('visibility_id', 3);
                    $query->where('post_type_id', $type);
                    $query->select(DB::raw(1))
                        ->from('friends')
                        ->whereRaw('friends.user_id = posts.owner_id')
                        ->whereRaw('friends.friend_user_id = ' . $user_id);
                })
                ->orWhere(function ($query) use ($user_id, $type) {
                    $query->where('visibility_id', 4);
                    $query->where('post_type_id', $type);
                    $query->where('owner_id', $user_id);
                })
                ->orderBy('priority', 'DESC')
                ->orderBy('updated_at', 'DESC')
                ->paginate($limit);

            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Collection($posts, new PostsTransformer);

            $postsResource->setPaginator(new IlluminatePaginatorAdapter($posts));

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
     * Update post priority
     * @param $post_id
     * @return mixed
     */
    public function updatePostPriority($post_id) {

        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $post_id = $post_id;
            $priority = $inputs_array['priority'];

            $posts = Post::find($post_id);



            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Post not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $posts->priority = $priority;

            $posts->save();

            $successMessage = [
                'status' => true,
                'message' => 'Post priority set successfully'
            ];

            return $this->setStatusCode(200)->respond($successMessage);

        }catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => $e
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }

    }


    public function searchPost()
    {
        try {
            $limit = 15;

            // Query to fetch all my posts and my friends post with images and
            // user data.

            $input = Input::all();

            $inputs_array = $input['data'];
            $title = "";
            $postTypeId = "%";
            $classificationId = null;
            $postBrand = null;
            $search_category = null;
            $search_subcategory = null;
            $priceRange = null;
            
            $posts = array();

//            $userId = $inputs_array['userId'];
            if (isset($inputs_array['title'])) {
                $title = $inputs_array['title'];
            }
            if (isset($inputs_array['postTypeId'])) {
                $postTypeId = $inputs_array['postTypeId'];
                if($postTypeId == ""){
                    $postTypeId ="%";
                }    
            }
            
            if (isset($inputs_array['search_classifi'])) {
                $classificationId = $inputs_array['search_classifi'];
                if($classificationId == ""){
                    $classificationId ="%";
                }
            }

            if (isset($inputs_array['postBrand'])) {
                $postBrand = $inputs_array['postBrand'];
                if($postBrand == ""){
                    $postBrand ="%";
                }
            }

            if (isset($inputs_array['search_cat'])) {
                $search_category = $inputs_array['search_cat'];
                if($search_category == ""){
                    $search_category ="%";
                }
            }

            if (isset($inputs_array['search_subcat'])) {
                $search_subcategory = $inputs_array['search_subcat'];
                if($search_subcategory == ""){
                    $search_subcategory ="%";
                }
            }

            if (isset($inputs_array['priceRange'])) {
                $priceRange = $inputs_array['priceRange'];
                if($priceRange == ""){
                    $priceRange ="%";
                }
            }
         
            $posts = Post::with('images', 'links', 'post_location', 'user.profile_image', 'brand', 'comments.user.profile_image', 'grades.user')
                ->Where('title', 'LIKE', "%$title%")    
                ->Where('post_type_id', 'LIKE', "$postTypeId")
                ->Where('classification_id', 'LIKE', "$classificationId")
                ->Where('brand_id', 'LIKE', "$postBrand")
                ->Where('cat_id', 'LIKE', "$search_category")
                ->Where('sub_cat_id', 'LIKE', "$search_subcategory")
                ->orderBySubmitDate()->paginate($limit);
//            if(isset($inputs_array['communityId']))
//            {
//                $communityId = $inputs_array['communityId'];
//            }


//            $posts = Post::with('images', 'links', 'post_location', 'user.profile_image', 'brand', 'comments.user.profile_image', 'grades.user')->where('post_type_id', $postTypeId)->Where('brand_id','=',$postBrand)->Where('price_range','<=',$priceRange)->Where('visibility_id','=',$communityId)->Where('title', 'LIKE', "%$title%")->Where('description', 'LIKE', "%$title%")->Where('testimonial', 'LIKE', "%$title%")
//                ->orderBySubmitDate()->paginate($limit);

            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Collection($posts, new PostsTransformer);

            $postsResource->setPaginator(new IlluminatePaginatorAdapter($posts));

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

    public function getRecco($user_id)
    {
        try {
            $limit = 15;

            // Query to fetch all my posts and my friends post with images and
            // user data.
            $posts = Post::with('images', 'links', 'post_location', 'user.profile_image', 'brand',
                'comments.user.profile_image', 'grades.user')
                ->where('visibility_id', 1)
                ->orWhereExists(function ($query) use ($user_id) {
                    $query->where('visibility_id', 2);
                    $query->select(DB::raw(1))
                        ->from('circle_friends')
                        ->whereRaw('circle_friends.friend_user_id = ' . $user_id)
                        ->whereExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('circles')
                                ->whereRaw('circles.id = circle_friends.circle_id')
                                ->whereRaw('circles.user_id = posts.owner_id');
                        });
                    $query->orWhere('owner_id', $user_id);

                })
                ->orWhereExists(function ($query) use ($user_id) {
                    $query->where('visibility_id', 3);
                    $query->select(DB::raw(1))
                        ->from('friends')
                        ->whereRaw('friends.user_id = posts.owner_id')
                        ->whereRaw('friends.friend_user_id = ' . $user_id);
                    $query->orWhere('owner_id', $user_id);
                })
                ->orWhere(function ($query) use ($user_id) {
                    $query->where('visibility_id', 4);
                    $query->where('owner_id', $user_id);
                })
                ->orderBySubmitDate()->paginate($limit);

            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Collection($posts, new PostsTransformer);

            $postsResource->setPaginator(new IlluminatePaginatorAdapter($posts));

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
     * @param $user_id
     * @return mixed|string
     * @internal param $user_id
     * @internal param $loggedin_user_id
     */
    public function getMyPosts($user_id)
    {
        try {
            $limit = 15;

            $inputs_array = Input::all();

            $user_id = $user_id;

            $loggedInUserId = $inputs_array['loggedin_user_id'];

            $posts = Post::with('images', 'post_location', 'links', 'user.profile_image',
                'brand', 'comments.user.profile_image', 'grades.user')
                ->where('visibility_id', 1)
                ->where('owner_id', $user_id)
                ->orWhereExists(function ($query) use ($user_id, $loggedInUserId) {
                    $query->where('visibility_id', 2);
                    $query->where('owner_id', $user_id);
                    $query->select(DB::raw(1))
                        ->from('circle_friends')
                        ->whereRaw('circle_friends.friend_user_id = ' . $user_id)
                        ->whereExists(function ($query) {
                            $query->select(DB::raw(1))
                                ->from('circles')
                                ->whereRaw('circles.id = circle_friends.circle_id')
                                ->whereRaw('circles.user_id = posts.owner_id');
                        });
                    $query->orWhere('visibility_id', 2);
                    $query->where('owner_id', $loggedInUserId);
                    $query->where('owner_id', $user_id);

                })
                ->orWhereExists(function ($query) use ($user_id, $loggedInUserId) {
                    $query->where('visibility_id', 3);
                    $query->where('owner_id', $user_id);
                    $query->select(DB::raw(1))
                        ->from('friends')
                        ->whereRaw('friends.user_id = posts.owner_id')
                        ->whereRaw('friends.friend_user_id = ' . $user_id);
                    $query->orWhere('visibility_id', 3);
                    $query->where('owner_id', $loggedInUserId);
                    $query->where('owner_id', $user_id);
                })
                ->orWhere(function ($query) use ($user_id, $loggedInUserId) {
                    $query->where('visibility_id', 4);
                    $query->where('owner_id', $user_id);
                    $query->where('owner_id', $loggedInUserId);
                })
                ->orderBy('created_at', 'DESC')->paginate($limit);

            if (!$posts) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }

            $fractal = new Manager();

            $postsResource = new Collection($posts, new PostsTransformer);

            $postsResource->setPaginator(new IlluminatePaginatorAdapter($posts));

            $data = $fractal->createData($postsResource);

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
     * @return mixed
     */
    public function getVisibility()
    {
        return Visibility::all();
    }

    /**
     * @param $user_id
     * @return mixed
     */


    public function updatePost()
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];
            $postId = $inputs_array['id'];
            $title = $inputs_array['title'];
            $description = $inputs_array['description'];
            $testimonial = $inputs_array['testimonial'];
            $visibility_id = $inputs_array['visibility_id'];
            $price_range = $inputs_array['price'];

            $post = Post::find($postId);
            $post->title = $title;
            $post->description = $description;
            $post->testimonial = $testimonial;
            $post->visibility_id = $visibility_id;
            $post->price_range = $price_range;

            $post->save();
            $successResponse = [
                'status' => true,
                'id' => $post->id,
                'message' => 'post updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function deletePost($postId)
    {
        try {
            $post = Post::where('id', $postId)->first();
            if (!$post) {
                $errorMessage = [
                    'status' => false,
                    'message' => "Posts not found!"
                ];

                return $this->setStatusCode(404)->responseNotFound($errorMessage);
            }
            $post->delete();
            $successResponse = [
                'status' => true,
                'message' => 'post removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {
            $errorMessage = [
                'status' => false,
                'message' => "Error occurred!"
            ];

            return $this->setStatusCode(500)->respondWithError($errorMessage);
        }
    }


    public function createPost($user_id)
    {
        try {
            $input = Input::all();

            $inputs_array = $input['data'];

            $locationToStore = array();

            $postArray = [];

            $postArray['title'] = $inputs_array['title'];
            $postArray['owner_id'] = $user_id;
            $postArray['visibility_id'] = $inputs_array['visibility_id'];
            $postArray['post_type_id'] = $inputs_array['post_type_id'];

            if (isset($inputs_array['category_id'])) {
                $postArray['cat_id'] = $inputs_array['category_id'];
            }

            if (isset($inputs_array['subcategory_id'])) {
                $postArray['sub_cat_id'] = $inputs_array['subcategory_id'];
            }
            
            if (isset($inputs_array['description'])) {
                $postArray['description'] = $inputs_array['description'];
            }

            if (isset($inputs_array['testimonial'])) {
                $postArray['testimonial'] = $inputs_array['testimonial'];
            }

            if (isset($inputs_array['brand_id'])) {
                $postArray['brand_id'] = $inputs_array['brand_id'];
            }

            if (isset($inputs_array['price_range'])) {
                $postArray['price_range'] = $inputs_array['price_range'];
            }
            if (isset($inputs_array['classification_id'])) {
                $postArray['classification_id'] = $inputs_array['classification_id'];
            }


            // Create the post
            $post = Post::create($postArray);

            // If url link for the post is set then save it
            if (isset($inputs_array['url_link'])) {
                $url_link = $inputs_array['url_link'];

                $link = Link::create([
                    'url_link' => $url_link
                ]);

                $postLink = PostLink::create([
                    'link_id' => $link->id,
                    'post_id' => $post->id
                ]);
            }

            // Parse the google location details and store.
            if (isset($inputs_array['location'])) {
                $location = $inputs_array['location'];

                $address_parts = array(
                    'street_address' => array("neighborhood"),
                    'street_address2' => array("sublocality_level_3", "sublocality"),
                    'locality' => array('sublocality_level_1', 'sublocality'),
                    'city' => array('locality'),
                    'state' => array('administrative_area_level_1'),
                    'country' => array('country'),
                    'zip' => array('postal_code'),
                );
                if (!empty($location)) {
                    $ac = $location;
                    foreach ($address_parts as $need => $types) {
                        foreach ($ac as $a) {
                            if (in_array($a['types'][0], $types)) {
                                $locationToStore[$need] = $a['long_name'];

                                if ($a['types'][0] == 'administrative_area_level_1') {
                                    $locationToStore['state_code'] = $a['short_name'];
                                }
                                if ($a['types'][0] == 'country') {
                                    $locationToStore['country_code'] = $a['short_name'];
                                }
                            } elseif (empty($locationToStore[$need])) {
                                $locationToStore[$need] = '';
                            }
                        }
                    }
                }

                $createdLocation = Location::create($locationToStore);

                PostLocation::create([
                    'location_id' => $createdLocation->id,
                    'post_id' => $post->id
                ]);
            }

            if ($inputs_array['images']) {
                $images = $inputs_array['images'];

                foreach ($images as $imageName) {
                    $evezImg = EvezownImage::create([
                            'large_image_url' => $imageName
                        ]
                    );

                    $finalImg = PostImage::create([
                        'image_id' => $evezImg->id,
                        'post_id' => $post->id
                    ]);
                }
            }

            $successResponse = [
                'status' => true,
                'post_id' => $post->id,
                'message' => 'Post submitted successfully!'
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
     * @param $post_id
     * @param $rewoicer_id
     * @return mixed
     * @internal param $user_id
     */
    public function createRewoicePost($user_id, $post_id)
    {
        try {
            $post = Post::find($post_id);

            $rewoicePost = Post::create([
                'title' => $post['title'],
                'owner_id' => $user_id,
                'description' => $post['description'],
                'visibility_id' => $post['visibility_id'],
                'post_type_id' => $post['post_type_id'],
                'testimonial' => $post['testimonial'],
                'brand_id' => $post['brand_id'],
                'location' => $post['location'],
                'price_range' => $post['price_range']
            ]);

            if ($post['images']) {
                $images = $post['images'];

                foreach ($images as $imageName) {
                    $evezImg = EvezownImage::create([
                            'large_image_url' => $imageName->large_image_url
                        ]
                    );

                    $finalImg = PostImage::create([
                        'image_id' => $evezImg->id,
                        'post_id' => $rewoicePost->id
                    ]);
                }
            }

            PostRewoice::create([
                'post_id' => $post_id,
                'rewoicer_id' => $user_id
            ]);

            $rewoiceCount = count(PostRewoice::where('post_id', $post_id)->get());

            $successResponse = [
                'status' => true,
                'message' => 'Post Restreamed Successfully!',
                'rewoiceCount' => $rewoiceCount
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
     * @return mixed
     */
    public function addBrand()
    {
        try {
            $input = Input::all();
            
            $brandImageName = "";//If no logo uploaded

            $inputs_array = $input['data'];

            $brandTitle = $inputs_array['title'];

            $subCatId = $inputs_array['subCatId'];

            if (isset($inputs_array['image_name'])) {
                $brandImageName = $inputs_array['image_name'];
            }

            $AddedBrand = Brand::create([
                'title' => $brandTitle,
                'image_name' => $brandImageName,
                'sub_cat_id' => $subCatId
            ]);

            $successResponse = [
                'status' => true,
                'message' => 'Brand added successfully!',
                'Brand_id' => $AddedBrand->id
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
     * Get all brands coming under a sub category.
     * @param $subCatId
     * @return mixed
     */
    public function getBrands($subCatId)
    {
        try {
            $brand = Brand::all();

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

    /**
     * Get all brands coming under a sub category.
     * @param $subCatId
     * @return mixed
     */
    public function findBrands($subCatId, $searchKey)
    {
        try {

            $brand = Brand::where('sub_cat_id', $subCatId)
                ->where('title', 'LIKE', "$searchKey%")->get();

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

}