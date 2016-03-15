<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;

class EvezplaceTrendingController extends AppController
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
            $evezplaceTrendingItems = EvezplaceTrendingItem::with('image', 'evezown_section')
                ->where('evezown_section_id', $sectionId)->orderBy('priority', 'desc')->paginate(20);

            if (!$evezplaceTrendingItems) {
                return $this->responseNotFound('No evezown trending items exist!');
            }

            $fractal = new Manager();

            $evezplaceTrendingResource = new Collection($evezplaceTrendingItems,
                new EvezplaceTrendingItemTransformer());

            $evezplaceTrendingResource->setPaginator(new IlluminatePaginatorAdapter($evezplaceTrendingItems));

            $data = $fractal->createData($evezplaceTrendingResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Load evezown recommendation item used for auto save purpose
     * @param $trendingItemId
     * @return Exception|mixed
     */
    public function show($trendingItemId)
    {
        try {
            $evezplaceTrendingItem = EvezplaceTrendingItem::with('image')
                ->find($trendingItemId);

            if (!$evezplaceTrendingItem) {
                return $this->responseNotFound('No evezown trending item exist!');
            }

            return $evezplaceTrendingItem;
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
                $evezplaceTrendingItem = EvezplaceTrendingItem::find($inputs_array['id']);

                $evezplaceTrendingItem->title = $title;
                $evezplaceTrendingItem->description = $description;
                $evezplaceTrendingItem->link = $link;
                $evezplaceTrendingItem->evezown_section_id = $sectionId;
                $evezplaceTrendingItem->priority = $priority;

                $evezplaceTrendingItem->save();

            } else {
                $evezplaceTrendingItem = EvezplaceTrendingItem::create([
                    'evezown_section_id' => $sectionId,
                    'title' => $title,
                    'description' => $description,
                    'link' => $link,
                    'priority' => $priority,
                ]);
            }

            $successResponse = [
                'status' => true,
                'id' => $evezplaceTrendingItem->id,
                'message' => 'Trending item added successfully!'
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
    public function updateTrendingItemImage($user_id, $sectionId)
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
                    $evezplaceTrendingItem = EvezplaceTrendingItem::find($inputs_array['id']);
                    $evezplaceTrendingItem->evezown_section_id = $sectionId;
                    $evezplaceTrendingItem->image_id = $evezownImage->id;

                    $evezplaceTrendingItem->save();
                } else {
                    $evezplaceTrendingItem = EvezplaceTrendingItem::create([
                        'evezown_section_id' => $sectionId,
                        'image_id' => $evezownImage->id
                    ]);
                }
            } catch (Exception $ex) {
                return $ex;
            }

            $successResponse = [
                'status' => true,
                'id' => $evezplaceTrendingItem->id,
                'message' => 'Trending item image uploaded successfully!'
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
     * Get all trending blogs to be shown on evezplace.
     * @param $sectionId
     * @return Exception|mixed|string
     */
    public function getTrendingBlogs($sectionId)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $blogs = Blog::with('author.profile_image',
                'subcategory.category', 'comments.profile.profile_image',
                'blog_image', 'trending')
                ->where('status', 'published')
                ->whereIn('id', function ($query) use ($sectionId) {
                    $query->select('blog_id')
                        ->from('evezplace_trending_blogs')
                        ->where('evezown_section_id', $sectionId)
                        ->where('is_show_evezplace', 1)
                        ->orderBy('priority', 'desc');
                })
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

    public function updateTrendingBlog($user_id, $blogId)
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

            $priority = isset($inputs_array['priority']) ? $inputs_array['priority'] : 0;
            $sectionId = $inputs_array['selectedSectionId'];
            $isShowEvezplace = $inputs_array['is_show_evezplace'];

            $evezplaceTrendingItem = EvezplaceTrendingBlog::firstOrCreate([
                'blog_id' => $blogId
            ]);

            $evezplaceTrendingItem->priority = (int) $priority;
            $evezplaceTrendingItem->is_show_evezplace = $isShowEvezplace;
            $evezplaceTrendingItem->evezown_section_id = $sectionId;

            $evezplaceTrendingItem->save();

            $successResponse = [
                'status' => true,
                'id' => $evezplaceTrendingItem->id,
                'message' => 'Trending blog added to Marketplace successfully!'
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


    public function updateTrendingEvent($user_id, $eventId)
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

            $priority = isset($inputs_array['priority']) ? $inputs_array['priority'] : 0;
            $sectionId = $inputs_array['selectedSectionId'];
            $isShowEvezplace = $inputs_array['is_show_evezplace'];

            $evezplaceTrendingItem = EvezplaceTrendingEvent::firstOrCreate([
                'event_id' => $eventId
            ]);

            $evezplaceTrendingItem->priority = (int) $priority;
            $evezplaceTrendingItem->is_show_evezplace = $isShowEvezplace;
            $evezplaceTrendingItem->evezown_section_id = $sectionId;

            $evezplaceTrendingItem->save();

            $successResponse = [
                'status' => true,
                'id' => $evezplaceTrendingItem->id,
                'message' => 'Trending blog added to marketplace successfully!'
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

    public function updateTrendingForum($user_id, $forumId)
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

            $priority = isset($inputs_array['priority']) ? $inputs_array['priority'] : 0;
            $sectionId = $inputs_array['selectedSectionId'];
            $isShowEvezplace = $inputs_array['is_show_evezplace'];

            $evezplaceTrendingItem = EvezplaceTrendingForum::firstOrCreate([
                'forum_id' => $forumId
            ]);

            $evezplaceTrendingItem->priority = (int) $priority;
            $evezplaceTrendingItem->is_show_evezplace = $isShowEvezplace;
            $evezplaceTrendingItem->evezown_section_id = $sectionId;

            $evezplaceTrendingItem->save();

            $successResponse = [
                'status' => true,
                'id' => $evezplaceTrendingItem->id,
                'message' => 'Trending discussion added to marketplace successfully!'
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
     * Get trending events to be shown on evezplace section
     * @param $sectionId
     * @return Exception|mixed|string
     */
    public function getTrendingEvents($sectionId)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $events = WoiceEvent::with('attendees.profile.profile_image',
                'event_image', 'location', 'owner')
                ->whereIn('id', function ($query) use ($sectionId) {
                    $query->select('event_id')
                        ->from('evezplace_trending_events')
                        ->where('evezown_section_id', $sectionId)
                        ->where('is_show_evezplace', 1)
                        ->orderBy('priority', 'desc');
                })
                ->paginate($limit);

            if(! $events)
            {
                return $this->responseNotFound('Events Not Found!');
            }

            $fractal = new Manager();

            $eventsResource = new Collection($events, new EventTransformer());

            $eventsResource->setPaginator(new IlluminatePaginatorAdapter($events));

            $data = $fractal->createData($eventsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    public function getTrendingForums($sectionId)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $events = Forum::with('replies.user.profile_image', 'created_by.profile_image', 'subcategory.category')
                ->whereIn('id', function ($query) use ($sectionId) {
                    $query->select('forum_id')
                        ->from('evezplace_trending_forums')
                        ->where('evezown_section_id', $sectionId)
                        ->where('is_show_evezplace', 1)
                        ->orderBy('priority', 'desc');
                })
                ->paginate($limit);

            if(! $events)
            {
                return $this->responseNotFound('Discussion Not Found!');
            }

            $fractal = new Manager();

            $eventsResource = new Collection($events, new ForumTransformer());

            $eventsResource->setPaginator(new IlluminatePaginatorAdapter($events));

            $data = $fractal->createData($eventsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }
}