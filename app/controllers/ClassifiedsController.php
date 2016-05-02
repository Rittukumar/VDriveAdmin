<?php

use Illuminate\Support\Facades\Mail;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ClassifiedsController extends AppController
{

    protected $albumTransformer;

    function __construct(ClassifiedsTransformer $albumTransformer)
    {
        $this->albumTransformer = $albumTransformer;
    }

    /**
     * Display a listing of the resource.
     * GET /classifieds
     *
     * @return Response
     */
    public function index()
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $classifieds = Classified::with('contact', 'location', 'images', 'tags')
                                        ->whereExists(function($query)
                                        {
                                            $query->select(DB::raw(1))
                                                  ->from('users')
                                                  ->whereRaw('users.id = classifieds.user_id')
                                                  ->whereRaw('blocked = 0')
                                                  ->whereRaw('deleted = 0');
                                        })
                                        ->paginate($limit);


            if (!$classifieds) {
                return $this->responseNotFound('No classifieds exist!');
            }

            $fractal = new Manager();

            $classifiedsResource = new Collection($classifieds, new ClassifiedsTransformer());

            $classifiedsResource->setPaginator(new IlluminatePaginatorAdapter($classifieds));

            $data = $fractal->createData($classifiedsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Get classifieds based on sub category.
     * @param $subCatId
     * @return Exception|string
     */
    public function getClassifieds($subCatId)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $query = Classified::with('contact', 'location', 'images', 'tags')
                ->where('status', 1)
                ->whereExists(function($query)
                    {
                        $query->select(DB::raw(1))
                              ->from('users')
                              ->whereRaw('users.id = classifieds.user_id')
                              ->whereRaw('blocked = 0')
                              ->whereRaw('deleted = 0');
                    })
                ->orderBy('updated_at', 'desc');

            if ($subCatId > 0) {
                $query->where('classified_subcategory_id', $subCatId);
            }

            $classifieds = $query->paginate($limit);

            if (!$classifieds) {
                return $this->responseNotFound('No classifieds exist!');
            }

            $fractal = new Manager();

            $classifiedsResource = new Collection($classifieds, new ClassifiedsTransformer());

            $classifiedsResource->setPaginator(new IlluminatePaginatorAdapter($classifieds));

            $data = $fractal->createData($classifiedsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * @return mixed|string
     */
    public function searchClassifieds()
    {
        try {

            $input = Input::all();

            $query = Classified::with('contact', 'location', 'images', 'tags')
                                ->where('status', 1)
                                ->whereExists(function($query)
                                    {
                                        $query->select(DB::raw(1))
                                              ->from('users')
                                              ->whereRaw('users.id = classifieds.user_id')
                                              ->whereRaw('blocked = 0')
                                              ->whereRaw('deleted = 0');
                                    });

            if (isset($input['searchKey'])) {
                $query->where('title', 'LIKE', '%' . $input['searchKey'] . '%');
            }

            if (isset($input['location'])) {
                $locationResource = App::make('LocationResource');

                $classifiedLocation = $locationResource->getLocationDetails($input['location']);

                $query->whereExists(function ($query) use ($classifiedLocation) {
                    $query->select(DB::raw(1))
                        ->from('classified_locations')
                        ->whereRaw('classified_locations.classified_id = classifieds.id')
                        ->whereRaw('classified_locations.city = ' . $classifiedLocation['city']);
                });
            }

            if (isset($input['selectedCategory'])) {
                $selectedCategoryId = $input['selectedCategory']['id'];

                //This is a products store. Add query for only products store.

                $query->where('classified_category_id', $selectedCategoryId);

                $subcategories = $input['subCategories'];

                $subCatIdArray = array();

                foreach ($subcategories as $index => $subcategory) {
                    if (isset($subcategory['isChecked']) && $subcategory['isChecked']) {
                        array_push($subCatIdArray, $subcategory['id']);
                    }
                }

                if (!empty($subCatIdArray)) {
                    $query->whereIn('classified_subcategory_id', $subCatIdArray);
                }
            }

            $paginator = $query->orderBy('created_at', 'DESC')->paginate(10);

            $allClasssifieds = $paginator->getCollection();

            if (!$allClasssifieds) {
                return $this->responseNotFound('Classified Listing Not Found!');
            }

            $fractal = new Manager();

            $classifiedsResource = new Collection($allClasssifieds, new ClassifiedsTransformer());

            $classifiedsResource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            $data = $fractal->createData($classifiedsResource);

            return $data->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get classifieds based on sub category.
     * @param $userId
     * @return Exception|string
     */
    public function getMyClassifieds($userId)
    {
        try {
            $limit = Input::get('limit') ?: 15;

            $classifieds = Classified::with('contact', 'location', 'images', 'tags')
                                        ->where('user_id', $userId)
                                        ->whereExists(function($query)
                                            {
                                                $query->select(DB::raw(1))
                                                      ->from('users')
                                                      ->whereRaw('users.id = classifieds.user_id')
                                                      ->whereRaw('blocked = 0')
                                                      ->whereRaw('deleted = 0');
                                            })
                                        ->orderBy('updated_at', 'desc')
                                        ->paginate($limit);

            if (!$classifieds) {
                return $this->responseNotFound('No classifieds exist!');
            }

            $fractal = new Manager();

            $classifiedsResource = new Collection($classifieds, new ClassifiedsTransformer());

            $classifiedsResource->setPaginator(new IlluminatePaginatorAdapter($classifieds));

            $data = $fractal->createData($classifiedsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Get classifieds based on sub category.
     * @param $classifiedId
     * @return Exception|string
     * @internal param $userId
     */
    public function getClassified($classifiedId)
    {
        try {
            $classified = Classified::with('contact', 'location', 'images', 'tags.tag')
                                     ->whereExists(function($query)
                                        {
                                            $query->select(DB::raw(1))
                                                  ->from('users')
                                                  ->whereRaw('users.id = classifieds.user_id')
                                                  ->whereRaw('blocked = 0')
                                                  ->whereRaw('deleted = 0');
                                        })
                                     ->find($classifiedId);

            if (!$classified) {
                return $this->responseNotFound('No classified exist!');
            }

            $fractal = new Manager();

            $classifiedsResource = new Item($classified, new ClassifiedsTransformer());

            $data = $fractal->createData($classifiedsResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /classifieds
     *
     * @param $user_id
     * @return Response
     */
    public function storeStep1($user_id)
    {
        try {
            $input_array = Input::all();

            $userId = (int)$user_id;

            $classifiedId = $input_array['id'];
            $classifiedFor = $input_array['classified_for'];
            $catId = $input_array['classified_category_id'];
            $subCatId = $input_array['classified_subcategory_id'];
            $classifiedType = $input_array['classified_type'];
            $startDate = $input_array['classifiedDateRange']['startDate'];
            $endDate = $input_array['classifiedDateRange']['endDate'];
            $tags = $input_array['tags'];

            $classified = Classified::find($classifiedId);

            if (!$classified) {
                $classified = Classified::create([
                    'user_id' => $userId,
                    'classified_for' => $classifiedFor,
                    'classified_type' => $classifiedType,
                    'classified_category_id' => $catId,
                    'classified_subcategory_id' => $subCatId,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                ]);
            } else {
                $classified->user_id = $userId;
                $classified->classified_for = $classifiedFor;
                $classified->classified_type = $classifiedType;
                $classified->classified_category_id = $catId;
                $classified->classified_subcategory_id = $subCatId;
                $classified->start_date = $startDate;
                $classified->end_date = $endDate;
                $classified->save();
            }


            foreach ($tags as $tag) {

                $existingTag = Tag::firstOrCreate(array('name' => $tag['name']));

                $classifiedTag = ClassifiedTag::where('tag_id', $existingTag->id)->first();

                if (!$classifiedTag) {
                    ClassifiedTag::create([
                        'tag_id' => $existingTag->id,
                        'classified_id' => $classified->id
                    ]);
                }
            }

            $successResponse = [
                'status' => true,
                'id' => $classified->id,
                'message' => 'Classified step 1 completed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    // Remove classified tag
    public function removeClassifiedTag($tagId)
    {
        try {
            $classifiedTag = ClassifiedTag::where('tag_id', $tagId)->first();

            if ($classifiedTag) {
                $classifiedTag->delete();
            }

            $successResponse = [
                'status' => true,
                'message' => 'Classified tag removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        } catch (Exception $ex) {
            return $this->setStatusCode(500)->respondWithError($ex);
        }
    }

    // Update classified status to 0 or 1.
    public function updateClassifiedStatus($classified_id)
    {
        try {
            $input_array = Input::all();

            $classifiedId = $classified_id;
            $status = $input_array['status'];

            $classified = Classified::find($classifiedId);

            if (!$classified) {
                return $this->responseNotFound('No classifieds exist!');
            }

            $classified->status = $status;
            $classified->save();

            $successResponse = [
                'status' => true,
                'message' => 'Classified status updated to ' + $status == 1 ? 'active' : 'inactive'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /classifieds
     *
     * @return Response
     */
    public function storeStep2()
    {
        try {
            $input_array = Input::all();

            $classifiedId = $input_array['id'];
            $classifiedLayoutType = $input_array['layoutType'];
            $classifiedTitle = $input_array['classifiedTitle'];
            $classifiedDesc = $input_array['classifiedDesc'];

            $titleImage = $input_array['titleImage']['croppedImage'];
            $bodyImage1 = $input_array['bodyImage1']['croppedImage'];
            $bodyImage2 = $input_array['bodyImage2']['croppedImage'];
            $bodyImage3 = $input_array['bodyImage3']['croppedImage'];
            $bodyImage4 = $input_array['bodyImage4']['croppedImage'];
            $dealDescription = $input_array['dealDescription'];
            $phoneNum = $input_array['contactDetails']['phoneNum'];
            $email = $input_array['contactDetails']['email'];
            $name = $input_array['contactDetails']['name'];
            $streetAddress = $input_array['storeLocation']['streetAddress'];
            $pincode = $input_array['storeLocation']['pincode'];

            $city = "";
            $state = "";
            $country = "";

            // Parse the google location details and store.
            if (isset($input_array['storeLocation']['cityState'])) {
                $location = $input_array['storeLocation']['cityState'];

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
                    if (isset($location['address_components'])) {
                        $ac = $location['address_components'];

                        foreach ($address_parts as $need => $types) {
                            foreach ($ac as $a) {
                                if (in_array($a['types'][0], $types)) {
                                    if ($a['types'][0] == 'administrative_area_level_1') {
                                        $state = $a['long_name'];
                                    }
                                    if ($a['types'][0] == 'country') {
                                        $country = $a['long_name'];
                                    }
                                    if ($a['types'][0] == 'locality') {
                                        $city = $a['long_name'];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            $classified = Classified::find($classifiedId);

            $classified->layout_type = $classifiedLayoutType;
            $classified->title = $classifiedTitle;
            $classified->description = $classifiedDesc;
            $classified->deal_description = $dealDescription;

            $classified->save();

            $classifiedImage = ClassifiedImage::firstOrCreate([
                'classified_id' => $classifiedId
            ]);

            $classifiedImage->title_image_name = $titleImage;
            $classifiedImage->body_image1_name = $bodyImage1;
            $classifiedImage->body_image2_name = $bodyImage2;
            $classifiedImage->body_image3_name = $bodyImage3;
            $classifiedImage->body_image4_name = $bodyImage4;

            $classifiedImage->save();

            $classifiedContact = ClassifiedContact::firstOrCreate([
                'classified_id' => (int)$classifiedId
            ]);

            $classifiedContact->phone = $phoneNum;
            $classifiedContact->email = $email;
            $classifiedContact->name = $name;

            $classifiedContact->save();

            $classifiedLocation = ClassifiedLocation::firstOrCreate([
                'classified_id' => (int)$classifiedId
            ]);

            $classifiedLocation->street_address = $streetAddress;
            $classifiedLocation->city = $city;
            $classifiedLocation->state = $state;
            $classifiedLocation->country = $country;
            $classifiedLocation->pincode = $pincode;

            $classifiedLocation->save();

            $successResponse = [
                'status' => true,
                'id' => $classified->id,
                'message' => 'Classified step 2 completed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /classifieds
     *
     * @return Response
     */
    public function storeStep3()
    {
        try {
            $input_array = Input::all();

            $classifiedId = $input_array['classifiedId'];
            $isMyEves = $input_array['is_my_eves'];
            $isMyCircles = $input_array['is_my_circles'];
            $isOnlyMe = $input_array['is_only_me'];
           // $isReccoItChannel = $input_array['is_recco_it_channel'];
            $isOpenToPublic = $input_array['is_open_to_public'];
            $isAddEnquiry = $input_array['is_add_enquiry'];
            $isFacebookShare = $input_array['is_facebook_share'];
            $isWhatsappShare = $input_array['is_watsapp_share'];
            $isGooglePlusShare = $input_array['is_googleplus_share'];
            $isTwitterShare = $input_array['is_twitter_share'];
            $isDirectMessageShare = $input_array['is_direct_message_share'];
            $isGmailShare = $input_array['is_gmail_share'];
            $isLinkedinShare = $input_array['is_linkedin_share'];
            $isEmailShare = $input_array['is_email_share'];
            $isViewsAnalytics = $input_array['is_views_analytics'];

            $isEnquiriesAnalytics = $input_array['is_enquires_analytics'];

            $isSendsAnalytics = $input_array['is_sends_analytics'];

            $isGradeitAnalytics = $input_array['is_gradeit_analytics'];

            $isVisibilitySummaryAnalytics = $input_array['is_visibility_summary_analytics'];

            $classified = Classified::find($classifiedId);

            $classified->is_my_eves = $isMyEves;
            $classified->is_my_circles = $isMyCircles;
            $classified->is_only_me = $isOnlyMe;
           // $classified->is_recco_it_channel = $isReccoItChannel;
            $classified->is_open_to_public = $isOpenToPublic;
            $classified->is_add_enquiry = $isAddEnquiry;
            $classified->is_facebook_share = $isFacebookShare;
            $classified->is_watsapp_share = $isWhatsappShare;
            $classified->is_googleplus_share = $isGooglePlusShare;
            $classified->is_twitter_share = $isTwitterShare;
            $classified->is_direct_message_share = $isDirectMessageShare;
            $classified->is_gmail_share = $isGmailShare;
            $classified->is_linkedin_share = $isLinkedinShare;
            $classified->is_email_share = $isEmailShare;
            $classified->is_views_analytics = $isViewsAnalytics;
            $classified->is_enquires_analytics = $isEnquiriesAnalytics;
            $classified->is_sends_analytics = $isSendsAnalytics;
            $classified->is_gradeit_analytics = $isGradeitAnalytics;
            $classified->is_visibility_summary_analytics = $isVisibilitySummaryAnalytics;

            $classified->save();

            $successResponse = [
                'status' => true,
                'id' => $classified->id,
                'message' => 'Classified step 3 completed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Create classified request for information.
     * @param $classified_id
     * @return mixed
     */
    public function createRequestInfo($classified_id)
    {
        try {
            $input_array = Input::all();

            $locationResource = App::make('LocationResource');

            $classifiedId = $classified_id;
            $name = isset($input_array['name'])? $input_array['name'] : "";
            $mobileNumber = isset($input_array['mobileNumber']) ? $input_array['mobileNumber'] : "";
            $email = isset($input_array['email']) ? $input_array['email'] : "";

            $enquiryLocation = null;

            if (isset($input_array['city']))
                $enquiryLocation = $locationResource->getLocationDetails($input_array['city']);

            $isContactEmail = isset($input_array['isContactEmail']) ? $input_array['isContactEmail'] : false;
            $isContactMobile = isset($input_array['isContactMobile']) ? $input_array['isContactMobile'] : false;
            $classifiedEnquiryInfo = isset($input_array['classifiedEnquiryInfo']) ? $input_array['classifiedEnquiryInfo'] : '';
            $classifiedFeedback = isset($input_array['classifiedFeedback']) ? $input_array['classifiedFeedback'] : '';
            $classifiedComments = isset($input_array['classifiedComments']) ? $input_array['classifiedComments'] : '';

            $requestInfo = RequestInfo::create([
                'name' => $name,
                'mobile' => $mobileNumber,
                'email' => $email,
                'city' => $enquiryLocation['city'],
                'is_contact_email' => $isContactEmail,
                'is_contact_phone' => $isContactMobile,
                'other_info' => $classifiedEnquiryInfo,
                'other_feedback' => $classifiedFeedback,
                'comment' => $classifiedComments
            ]);

            $classifiedRequestInfo = ClassifiedRequestInfo::create([
                'rfi_id' => $requestInfo->id,
                'classified_id' => $classifiedId
            ]);

            // Send an invite email to classified owner notifying the rfi.

            $classifiedContact = ClassifiedContact::where('classified_id', $classifiedId)->first();

            $user = array(
                'email' => $email,
                'name' => $name
            );

            $data = array(
                'name' => $name,
                'email' => $email,
                'phone' => $mobileNumber,
                'city' => $enquiryLocation['city'],
                'is_contact_email' => $isContactEmail,
                'is_contact_phone' => $isContactMobile,
                'other_info' => $classifiedEnquiryInfo,
                'other_feedback' => $classifiedFeedback,
                'comment' => $classifiedComments,
            );

            $emails = [$classifiedContact->email, 'radhakrishnan.radha@gmail.com'];

            Mail::send('emails.classifiedRfi', $data, function ($message) use ($user, $emails) {
                $message->from($user['email'], $user['name']);
                $message->to($emails, 'Classified Enquiry')->subject('Evezown Ads & Campaigns Request for Info!');
            });

            $successResponse = [
                'status' => true,
                'id' => $classifiedRequestInfo->id,
                'message' => 'Classified request for info submitted successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get all request for info received for the classified
     * @param $classifiedId
     * @return Exception|mixed|string
     */
    public function getRequestForInfo($classifiedId)
    {
        try {
            $limit = Input::get('limit') ?: 10;

            $classifiedRfi = ClassifiedRequestInfo::with('request_info')
                ->where('classified_id', $classifiedId)
                ->orderBy('created_at', 'desc')
                ->paginate($limit);

            if (!$classifiedRfi) {
                return $this->responseNotFound('No classified RFI exist!');
            }

            $fractal = new Manager();

            $classifiedsRfiResource = new Collection($classifiedRfi, new ClassifiedsRfiTransformer());

            $classifiedsRfiResource->setPaginator(new IlluminatePaginatorAdapter($classifiedRfi));

            $data = $fractal->createData($classifiedsRfiResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

}