<?php

use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class StoreController extends AppController
{

    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function store()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];
            $storeAddress = '';
            $cityStateCountry = '';
            $pincode = '';
            $licenseInfo = '';
            $storeId = '';
            $storeAddress = '';
            $address = '';
            $userId = $input_array['user_id'];
            $title = $input_array['title'];
            $storeDescription = $input_array['storeDescription'];
            $owners = $input_array['owners'];

            if (isset($input_array['address'])) {
                $address = $input_array['address'];
            }

            if (isset($input_array['isPhysicalStore'])) {
                $isPhysicalStore = $input_array['isPhysicalStore'];
            } else {
                $isPhysicalStore = false;
            }

            if (isset($input_array['licenseInfo'])) {
                $licenseInfo = $input_array['licenseInfo'];
            } else {
                $licenseInfo = "";
            }

            if (isset($input_array['storeAddress'])) {
                $storeAddress = $input_array['storeAddress'];
            }

            if (isset($input_array['pincode'])) {
                $pincode = $input_array['pincode'];
            }
            $city = '';
            $state = '';
            $country = '';


            // Parse the google location details and store.
            if (isset($input_array['cityStateCountry'])) {
                $location = $input_array['cityStateCountry'];
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

            try {

                if (isset($input_array['storeId'])) {
                    $storeId = $input_array['storeId'];
                    $currentStore = Store::find($storeId);
                    $currentStore->title = $title;
                    $currentStore->description = $storeDescription;
                    $currentStore->license_info = $licenseInfo;
                    $currentStore->street_address = $address;
                    $currentStore->own_a_physical_store = $isPhysicalStore;
                    $currentStore->zip = $pincode;
                    $currentStore->city = $city;
                    $currentStore->state = $state;
                    $currentStore->country = $country;
                    $currentStore->owner_id = $userId;
                    $currentStore->web_address = $storeAddress;
                    $currentStore->save();
                } else {
                    $store = Store::create([
                        'title' => $title,
                        'description' => $storeDescription,
                        'license_info' => $licenseInfo,
                        'street_address' => $address,
                        'own_a_physical_store' => $isPhysicalStore,
                        'zip' => $pincode,
                        'city' => $city,
                        'state' => $state,
                        'country' => $country,
                        'owner_id' => $userId,
                        'web_address' => $storeAddress

                    ]);
                }


            } catch (Exception $ex) {
                return $ex;
            }

            for ($i = 0; $i < count($owners); $i++) {
                if (isset($owners[$i]['id'])) {
                    $ownerId = $owners[$i]['id'];
                    if ($ownerId == '') {
                        if (!isset($input_array['storeId'])) {
                            $owner = Owner::create([
                                'store_id' => $store->id,
                                'owner_name' => $owners[$i]['title']
                            ]);
                        } else {
                            $owner = Owner::create([
                                'store_id' => $currentStore->id,
                                'owner_name' => $owners[$i]['title']
                            ]);
                        }

                    }
                }

            }

            if (isset($input_array['storeId'])) {
                $successResponse = [
                    'status' => true,
                    'id' => $currentStore->id,
                    'message' => 'Store updated successfully!'
                ];
            } else {
                $successResponse = [
                    'status' => true,
                    'id' => $store->id,
                    'message' => 'Store updated successfully!'
                ];
            }

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function storeStep2()
    {
        try {
            $input = Input::all();

            $input_array = $input['data'];
            $storeId = $input_array['StoreId'];

            if (isset($input_array['storeType'])) {
                $storeType = $input_array['storeType'];
            } else {
                $storeType = '';
            }


            if (isset($input_array['panNumber'])) {
                $panNumber = $input_array['panNumber'];
            } else {
                $panNumber = '';
            }

            if (isset($input_array['tinNumber'])) {
                $tinNumber = $input_array['tinNumber'];
            } else {
                $tinNumber = '';
            }
            if (isset($input_array['vatNumber'])) {
                $vatNumber = $input_array['vatNumber'];
            } else {
                $vatNumber = '';
            }
            if (isset($input_array['serviceTaxId'])) {
                $serviceTaxId = $input_array['serviceTaxId'];
            } else {
                $serviceTaxId = '';
            }

            if (isset($input_array['tanNumber'])) {
                $tanNumber = $input_array['tanNumber'];
            } else {
                $tanNumber = '';
            }

            if (isset($input_array['evezownContract'])) {
                $evezownContract = $input_array['evezownContract'];
            } else {
                $evezownContract = '';
            }

            if (isset($input_array['billingName'])) {
                $billingName = $input_array['billingName'];
            } else {
                $billingName = '';
            }

            if (isset($input_array['billingAddress'])) {
                $billingAddress = $input_array['billingAddress'];
            } else {
                $billingAddress = '';
            }

            if (isset($input_array['billingContactNumber'])) {
                $billingContactNumber = $input_array['billingContactNumber'];
            } else {
                $billingContactNumber = '';
            }


            $currentStore = Store::find($storeId);

            if ($currentStore) {
                $currentStore->store_subscription_id = $storeType;
                $currentStore->save();
            }


            $storeBusinessInfo = StoreBusinessInfo::find($storeId);

            if (!$storeBusinessInfo) {
                $storeBusinessInfo = StoreBusinessInfo::create([
                    'store_id' => $storeId,
                    'pan_number' => $panNumber,
                    'tin_number' => $tinNumber,
                    'vat_number' => $vatNumber,
                    'tan_number' => $tanNumber,
                    'service_tax_id' => $serviceTaxId,
                    'store_contract_file' => $evezownContract,
                    'billing_info_name' => $billingName,
                    'billing_info_address' => $billingAddress,
                    'billing_info_contact_number' => $billingContactNumber,

                ]);
            } else {
                $storeBusinessInfo->store_id = $storeId;
                $storeBusinessInfo->pan_number = $panNumber;
                $storeBusinessInfo->tin_number = $tinNumber;
                $storeBusinessInfo->vat_number = $vatNumber;
                $storeBusinessInfo->tan_number = $tanNumber;
                $storeBusinessInfo->service_tax_id = $serviceTaxId;
                $storeBusinessInfo->store_contract_file = $evezownContract;
                $storeBusinessInfo->billing_info_name = $billingName;
                $storeBusinessInfo->billing_info_address = $billingAddress;
                $storeBusinessInfo->billing_info_contact_number = $billingContactNumber;
                $storeBusinessInfo->save();
            }


            $successResponse = [
                'status' => true,
                'id' => $storeBusinessInfo->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function storeStep3()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];
            if (isset($input_array['storeTitle'])) {
                $storeCaption = $input_array['storeTitle'];
            } else {
                $storeCaption = "";
            }

            if (isset($input_array['storeAboutUs'])) {
                $storeAboutUs = $input_array['storeAboutUs'];
            } else {
                $storeAboutUs = "";
            }

//            $storeOwnerInfo = $input_array['storeOwnerInfo'];
            if (isset($input_array['storeTargetAudience'])) {
                $targetAudience = $input_array['storeTargetAudience'];
            } else {
                $targetAudience = "";
            }

            if (isset($input_array['storeOfferings'])) {
                $offerings = $input_array['storeOfferings'];
            } else {
                $offerings = "";
            }

            if (isset($input_array['storeMotto'])) {
                $motto = $input_array['storeMotto'];
            } else {
                $motto = "";
            }

            if (isset($input_array['storeVision'])) {
                $vision = $input_array['storeVision'];
            } else {
                $vision = "";
            }

            if (isset($input_array['storePurpose'])) {
                $purpose = $input_array['storePurpose'];
            } else {
                $purpose = "";
            }

            if (isset($input_array['listingTypeId'])) {
                $listingTypeId = $input_array['listingTypeId'];
            } else {
                $listingTypeId = "";
            }

            if (isset($input_array['storeCategory'])) {
                $storeCategoryId = $input_array['storeCategory'];
            } else {
                $storeCategoryId = "";
            }

            if (isset($input_array['storeSubCategory'])) {
                $storeSubCategoryId = $input_array['storeSubCategory'];
            } else {
                $storeSubCategoryId = "";
            }


            if (isset($input_array['storeTags'])) {
                $storeTags = $input_array['storeTags'];
            } else {
                $storeTags = "";
            }

            if (isset($input_array['collage1'])) {
                $collage1 = $input_array['collage1'];
            }


            if (isset($input_array['collage2'])) {
                $collage2 = $input_array['collage2'];
            }


            if (isset($input_array['collage3'])) {
                $collage3 = $input_array['collage3'];
            }


            if (isset($input_array['profileImage'])) {
                $profileImage = $input_array['profileImage'];
            }


            $city = '';
            $state = '';
            $country = '';


            // Parse the google location details and store.
            if (isset($input_array['storeCity'])) {
                $location = $input_array['storeCity'];
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


            $storeFrontInfo = StoreFrontInfo::where('store_id', $storeId)->first();

            if (!$storeFrontInfo) {
                $storeFrontInfo = StoreFrontInfo::create([
                    'store_id' => $storeId,
                    'store_caption' => $storeCaption,
                    'store_about_us' => $storeAboutUs,
                    'target_audience' => $targetAudience,
                    'offerings' => $offerings,
                    'motto' => $motto,
                    'vision' => $vision,
                    'purpose' => $purpose,
                    'listing_type_id' => $listingTypeId,
                    'store_city' => $city,
                ]);
            } else {
                $storeFrontInfo->store_caption = $storeCaption;
                $storeFrontInfo->store_about_us = $storeAboutUs;
                $storeFrontInfo->target_audience = $targetAudience;
                $storeFrontInfo->offerings = $offerings;
                $storeFrontInfo->motto = $motto;
                $storeFrontInfo->vision = $vision;
                $storeFrontInfo->purpose = $purpose;
                $storeFrontInfo->listing_type_id = $listingTypeId;
                if ($city) {
                    $storeFrontInfo->store_city = $city;
                }
                $storeFrontInfo->save();
            }


            $currentStore = Store::find($storeId);

            $currentStore->store_category_id = $storeCategoryId;
            $currentStore->store_subcategory_id = $storeSubCategoryId;

            $currentStore->save();

            $storeFrontImages = StoreFrontImages::where('store_id', $storeId)->first();


            $profileImage1 = EvezownImage::create([
                    'large_image_url' => $profileImage
                ]
            );


            $collageImage1 = EvezownImage::create([
                    'large_image_url' => $collage1
                ]
            );


            $collageImage2 = EvezownImage::create([
                    'large_image_url' => $collage2
                ]
            );


            $collageImage3 = EvezownImage::create([
                    'large_image_url' => $collage3
                ]
            );


            if (!$storeFrontImages) {
                $storeFrontImages = StoreFrontImages::create([
                    'store_id' => $storeId,
                    'profile_image_id' => $profileImage1['id'],
                    'collage_image1_id' => $collageImage1['id'],
                    'collage_image2_id' => $collageImage2['id'],
                    'collage_image3_id' => $collageImage3['id']
                ]);
            } else {
                if ($profileImage) {

                    if ($profileImage != "") {
                        $storeFrontImages->profile_image_id = $profileImage1['id'];
                    }

                }

                if ($collageImage1) {

                    if ($collage1 != "") {
                        $storeFrontImages->collage_image1_id = $collageImage1['id'];
                    }

                }

                if ($collageImage2) {
                    if ($collage2 != "") {
                        $storeFrontImages->collage_image2_id = $collageImage2['id'];
                    }
                }

                if ($collageImage3) {
                    if ($collage3 != "") {
                        $storeFrontImages->collage_image3_id = $collageImage3['id'];
                    }
                }
                $storeFrontImages->save();
            }


            foreach ($storeTags as $tag) {
                try {
                    $storeTag = Tag::create([
                        'name' => $tag['text'],
                    ]);
                } catch (Exception $ex) {
                    return $ex;
                }

                $tags = StoreTags::create([
                    'store_id' => $storeId,
                    'tag_id' => $storeTag['id']
                ]);
            }

            $successResponse = [
                'status' => true,
                'id' => $storeFrontInfo->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $e;
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function storeStep4()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];

            if (isset($input_array['storeEmail'])) {
                $storeEmail = $input_array['storeEmail'];
            } else {
                $storeEmail = "";
            }

            if (isset($input_array['storePhone1'])) {
                $storePhone1 = $input_array['storePhone1'];
            } else {
                $storePhone1 = "";
            }

            if (isset($input_array['storePhone2'])) {
                $storePhone2 = $input_array['storePhone2'];
            } else {
                $storePhone2 = "";
            }

            if (isset($input_array['storePhone3'])) {
                $storePhone3 = $input_array['storePhone3'];
            } else {
                $storePhone3 = "";
            }

            if (isset($input_array['termsconditions'])) {
                $termsconditions = $input_array['termsconditions'];
            } else {
                $termsconditions = "";
            }

            if (isset($input_array['policies'])) {
                $policies = $input_array['policies'];
            } else {
                $policies = "";
            }

            if (isset($input_array['salesReturnPolicy'])) {
                $salesReturnPolicy = $input_array['salesReturnPolicy'];
            } else {
                $salesReturnPolicy = "";
            }

            if (isset($input_array['link1'])) {
                $link1 = $input_array['link1'];
            } else {
                $link1 = "";
            }

            if (isset($input_array['link2'])) {
                $link2 = $input_array['link2'];
            } else {
                $link2 = "";
            }

            if (isset($input_array['link3'])) {
                $link3 = $input_array['link3'];
            } else {
                $link3 = "";
            }


            $storeFrontInfo = StoreFrontInfo::where('store_id', $storeId)->first();

            if (!$storeFrontInfo) {
                $storeFrontInfo = StoreFrontInfo::create([
                    'store_id' => $storeId,
                    'store_contact_email' => $storeEmail,
                    'store_contact_phone1' => $storePhone1,
                    'store_contact_phone2' => $storePhone2,
                    'store_contact_phone3' => $storePhone3,
                    'store_terms_conditions' => $termsconditions,
                    'store_sales_exchange_policy' => $salesReturnPolicy,
                    'store_policies' => $policies,
                    'store_mandatory_disclosure_link1' => $link1,
                    'store_mandatory_disclosure_link2' => $link2,
                    'store_mandatory_disclosure_link3' => $link3
                ]);
            } else {

                if ($storeEmail != "")
                    $storeFrontInfo->store_contact_email = $storeEmail;
                if ($storePhone1 != "")
                    $storeFrontInfo->store_contact_phone1 = $storePhone1;
                if ($storePhone2 != "")
                    $storeFrontInfo->store_contact_phone2 = $storePhone2;
                if ($storePhone3 != "")
                    $storeFrontInfo->store_contact_phone3 = $storePhone3;
                if ($termsconditions != "")
                    $storeFrontInfo->store_terms_conditions = $termsconditions;
                if ($salesReturnPolicy != "")
                    $storeFrontInfo->store_sales_exchange_policy = $salesReturnPolicy;
                if ($policies != "")
                    $storeFrontInfo->store_policies = $policies;
                if ($link1 != "")
                    $storeFrontInfo->store_mandatory_disclosure_link1 = $link1;
                if ($link2 != "")
                    $storeFrontInfo->store_mandatory_disclosure_link2 = $link2;
                if ($link3 != "")
                    $storeFrontInfo->store_mandatory_disclosure_link3 = $link3;
                $storeFrontInfo->save();
            }


            $successResponse = [
                'status' => true,
                'id' => $storeFrontInfo->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    public function UpdateStoreFooterInfo()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];

            if (isset($input_array['termsconditions'])) {
                $termsconditions = $input_array['termsconditions'];
            } else {
                $termsconditions = "";
            }

            if (isset($input_array['policies'])) {
                $policies = $input_array['policies'];
            } else {
                $policies = "";
            }

            if (isset($input_array['salesReturnPolicy'])) {
                $salesReturnPolicy = $input_array['salesReturnPolicy'];
            } else {
                $salesReturnPolicy = "";
            }


            $storeFrontInfo = StoreFrontInfo::where('store_id', $storeId)->first();

            if ($storeFrontInfo) {
                if ($termsconditions != "")
                    $storeFrontInfo->store_terms_conditions = $termsconditions;
                if ($salesReturnPolicy != "")
                    $storeFrontInfo->store_sales_exchange_policy = $salesReturnPolicy;
                if ($policies != "")
                    $storeFrontInfo->store_policies = $policies;
                $storeFrontInfo->save();
            }


            $successResponse = [
                'status' => true,
                'id' => $storeFrontInfo->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function storeStep5()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];
            if (isset($input_array['classifiedTagline'])) {
                $classifiedTagline = $input_array['classifiedTagline'];
            } else {
                $classifiedTagline = "";
            }
            if (isset($input_array['classifiedPrice'])) {
                $classifiedPrice = $input_array['classifiedPrice'];
            } else {
                $classifiedPrice = "";
            }
            if (isset($input_array['classifiedDescription'])) {
                $classifiedDescription = $input_array['classifiedDescription'];
            } else {
                $classifiedDescription = "";
            }

            if (isset($input_array['classifiedImages'])) {
                $classifiedImages = $input_array['classifiedImages'];
            } else {
                $classifiedImages = null;
            }

            if (isset($input_array['classifiedImage1'])) {
                $classifiedImage1 = $input_array['classifiedImage1'];
            } else {
                $classifiedImage1 = null;
            }
            if (isset($input_array['classifiedImage2'])) {
                $classifiedImage2 = $input_array['classifiedImage2'];
            } else {
                $classifiedImage2 = null;
            }
            if (isset($input_array['classifiedImage3'])) {
                $classifiedImage3 = $input_array['classifiedImage3'];
            } else {
                $classifiedImage3 = null;
            }
            if (isset($input_array['classifiedImage4'])) {
                $classifiedImage4 = $input_array['classifiedImage4'];
            } else {
                $classifiedImage4 = null;
            }


            $storeFrontPromotion = StoreFrontPromotion::where('store_id', $storeId)->first();

            if (!$storeFrontPromotion) {
                $storeFrontPromotion = StoreFrontPromotion::create([
                    'store_id' => $storeId,
                    'promotion_tagline' => $classifiedTagline,
                    'promotion_price' => $classifiedPrice,
                    'promotion_description' => $classifiedDescription
                ]);
            } else {
                $storeFrontPromotion->promotion_tagline = $classifiedTagline;
                $storeFrontPromotion->promotion_price = $classifiedPrice;
                $storeFrontPromotion->promotion_description = $classifiedDescription;
                $storeFrontPromotion->save();
            }
            $imageId1 = '0';
            $imageId2 = '0';
            $imageId3 = '0';
            $imageId4 = '0';

            $cimageId1 = null;
            $cimageId2 = null;
            $cimageId3 = null;
            $cimageId4 = null;

            if ($classifiedImage1 != "") {
                $cimageId1 = EvezownImage::create([
                    'large_image_url' => $classifiedImage1
                ]);
            }

            if ($classifiedImage2 != "") {
                $cimageId2 = EvezownImage::create([
                    'large_image_url' => $classifiedImage2
                ]);
            }

            if ($classifiedImage3 != "") {
                $cimageId3 = EvezownImage::create([
                    'large_image_url' => $classifiedImage3
                ]);
            }

            if ($classifiedImage4 != "") {
                $cimageId4 = EvezownImage::create([
                    'large_image_url' => $classifiedImage4
                ]);
            }


            if ($cimageId1) {
                $imageId1 = $cimageId1['id'];
            }
            if ($cimageId2) {
                $imageId2 = $cimageId2['id'];
            }
            if ($cimageId3) {
                $imageId3 = $cimageId3['id'];
            }
            if ($cimageId4) {
                $imageId4 = $cimageId4['id'];
            }


            $promo = StoreFrontPromotionImages::where('store_promotion_id', $storeFrontPromotion->id)->first();

            if (!$promo) {
                $promo = StoreFrontPromotionImages::create([
                    'store_promotion_id' => $storeFrontPromotion->id,
                    'promotion_image1_id' => $imageId1,
                    'promotion_image2_id' => $imageId2,
                    'promotion_image3_id' => $imageId3,
                    'promotion_image4_id' => $imageId4
                ]);
            } else {
                $promo->promotion_image1_id = $imageId1;
                if ($imageId2 != '0') {
                    $promo->promotion_image2_id = $imageId2;
                }
                if ($imageId3 != '0') {
                    $promo->promotion_image3_id = $imageId3;
                }
                if ($imageId4 != '0') {
                    $promo->promotion_image4_id = $imageId4;
                }

                $promo->save();
            }


            $successResponse = [
                'status' => true,
                'id' => $storeFrontPromotion->id,
                'message' => 'Store updated successfully!'
            ];


            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $e;
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function SaveCommerceData()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];
            if (isset($input_array['isGateWayNeeded'])) {
                $isGetWayNeeded = $input_array['isGateWayNeeded'];
            } else {
                $isGetWayNeeded = false;
            }
            if (isset($input_array['address'])) {
                $address = $input_array['address'];
            } else {
                $address = "";
            }

            $city = '';
            $state = '';
            $country = '';


            // Parse the google location details and store.
            if (isset($input_array['cityStateCountry'])) {
                $location = $input_array['cityStateCountry'];
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


            if (isset($input_array['pincode'])) {
                $pincode = $input_array['pincode'];
            } else {
                $pincode = "";
            }

            if (isset($input_array['isOffline'])) {
                $isOffline = $input_array['isOffline'];
            } else {
                $isOffline = false;
            }

            if (isset($input_array['isCashOnDelivery'])) {
                $isCashOnDelivery = $input_array['isCashOnDelivery'];
            } else {
                $isCashOnDelivery = false;
            }

            if (isset($input_array['isChequePayment'])) {
                $isChequePayment = $input_array['isChequePayment'];
            } else {
                $isChequePayment = false;
            }

            if (isset($input_array['contactNumber'])) {
                $contactNumber = $input_array['contactNumber'];
            } else {
                $contactNumber = "";
            }

            if (isset($input_array['vendorName'])) {
                $vendorName = $input_array['vendorName'];
            } else {
                $vendorName = "";
            }

            if (isset($input_array['additionalInfo'])) {
                $additionalInfo = $input_array['additionalInfo'];
            } else {
                $additionalInfo = "";
            }


            $storeCommerce = Commerce::where('store_id', $storeId)->first();

            if (!$storeCommerce) {
                $storeCommerce = Commerce::create([
                    'store_id' => $storeId,
                    'is_payment_gateway_needed' => $isGetWayNeeded,
                    'billing_address' => $address,
                    'billing_city' => $city,
                    'billing_state' => $state,
                    'billing_country' => $country,
                    'billing_pincode' => $pincode,
                    'is_offline_payment' => $isOffline,
                    'is_cash_delivery' => $isCashOnDelivery,
                    'is_cheque_payment' => $isChequePayment,
                    'contact_number' => $contactNumber,
                    'vendor_name' => $vendorName,
                    'additional_info' => $additionalInfo
                ]);
            } else {
                $storeCommerce->is_payment_gateway_needed = $isGetWayNeeded;
                $storeCommerce->billing_address = $address;
                $storeCommerce->billing_city = $city;
                $storeCommerce->billing_state = $state;
                $storeCommerce->billing_country = $country;
                $storeCommerce->billing_pincode = $pincode;
                $storeCommerce->is_offline_payment = $isOffline;
                $storeCommerce->is_cash_delivery = $isCashOnDelivery;
                $storeCommerce->is_cheque_payment = $isChequePayment;
                $storeCommerce->contact_number = $contactNumber;
                $storeCommerce->vendor_name = $vendorName;
                $storeCommerce->additional_info = $additionalInfo;
                $storeCommerce->save();
            }
            $successResponse = [
                'status' => true,
                'id' => $storeCommerce->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /register
     *
     * @return Response
     */
    public function storeStep6()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];
            $linkPersonalProfileToStore = $input_array['linkPersonalProfileToStore'];
            $reccoSub = $input_array['reccoSub'];
            $facebookLink = $input_array['facebookLink'];
            $twitterLink = $input_array['twitterLink'];
            $linkedinLink = $input_array['linkedinLink'];
            $websiteUrl = $input_array['websiteUrl'];
            $priceList = $input_array['storePriceList'];

            $storeAdvertising = StoreAdvertising::find($storeId);

            if (!$storeAdvertising) {
                $storeAdvertising = StoreAdvertising::create([
                    'store_id' => $storeId,
                    'store_front_to_personal_profile' => $linkPersonalProfileToStore,
                    'recco_subscription_id' => $reccoSub,
                    'store_facebook_link' => $facebookLink,
                    'store_twitter_link' => $twitterLink,
                    'store_linkedin_link' => $linkedinLink,
                    'store_website_link' => $websiteUrl,
                    'store_price_list' => $priceList
                ]);
            } else {
                $storeAdvertising->store_front_to_personal_profile = $linkPersonalProfileToStore;
                $storeAdvertising->recco_subscription_id = $reccoSub;
                $storeAdvertising->store_facebook_link = $facebookLink;
                $storeAdvertising->store_twitter_link = $twitterLink;
                $storeAdvertising->store_linkedin_link = $linkedinLink;
                $storeAdvertising->store_website_link = $websiteUrl;
                $storeAdvertising->store_price_list = $priceList;
                $storeAdvertising->save();
            }


            StoreStatus::create([
                'store_id' => $storeId,
                'status_id' => 2,
            ]);

            $successResponse = [
                'status' => true,
                'id' => $storeAdvertising->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /update store status
     *
     * @return Response
     */
    public function updateStoreStatus()
    {
        try {
            $input = Input::all();


            $input_array = $input['data'];

            $storeId = $input_array['StoreId'];
            $storeStatusId = $input_array['storeStatus'];


            $storeStatus = StoreStatus::where('store_id', $storeId)->first();

            if (!$storeStatus) {
                $storeStatus = StoreStatus::create([
                    'store_id' => $storeId,
                    'status_id' => (int)$storeStatusId,
                ]);
            } else {
                $storeStatus->status_id = (int)$storeStatusId;
                $storeStatus->save();
            }

            $successResponse = [
                'status' => true,
                'id' => $storeStatus->id,
                'message' => 'Store updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getStoreStatus($storeId)
    {
        try {
            $storeStatus = StoreStatus::where('store_id', $storeId)->first();

            if (!$storeStatus) {
                return $this->responseNotFound('Store status Not Found!');
            }
            return $storeStatus->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getStoreStatusEnum()
    {
        try {
            $storeStatus = StoreStatusEnum::all();

            if (!$storeStatus) {
                return $this->responseNotFound('Store status Not Found!');
            }
            return $storeStatus->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Display the specified resource.
     * GET /register/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /register/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function getAllStoreListing()
    {
        try {
            $storeListing = StoreListing::all();

            if (!$storeListing) {
                return $this->responseNotFound('Store Listing Not Found!');
            }
            return $storeListing->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Display the specified resource.
     * GET /register/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function getAllStoreSubscription()
    {
        try {
            $storeSubscription = StoreSubscriptionType::all();

            if (!$storeSubscription) {
                return $this->responseNotFound('Store Listing Not Found!');
            }
            return $storeSubscription->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    public function getAllStores()
    {
        try {
            $allStores = Store::with('profile', 'profile_images', 'collage_image1', 'collage_image2',
                'collage_image3', 'StoreFrontInfo', 'StoreFrontPromotion', 'StoreFrontPromotion.image.image1',
                'StoreFrontPromotion.image.image2', 'StoreFrontPromotion.image.image3',
                'StoreFrontPromotion.image.image4', 'StoreStatus')->get();

            if (!$allStores) {
                return $this->responseNotFound('Store Listing Not Found!');
            }
            return $allStores->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getStoreById($store_Id)
    {
        try {
            $store = Store::with('profile', 'profile_images',
                'collage_image1', 'collage_image2',
                'collage_image3', 'StoreFrontInfo',
                'owner', 'BusinessInfo', 'Tags',
                'StoreFrontPromotion',
                'StoreFrontPromotion.image.image1',
                'StoreFrontPromotion.image.image2',
                'StoreFrontPromotion.image.image3',
                'StoreFrontPromotion.image.image4',
                'StoreCommerce', 'TrendingProducts.Images',
                'TrendingProducts.Details', 'StoreStatus',
                'StoreAdvertising')
                ->where('id', $store_Id)
                ->get();

            if (!$store) {
                return $this->responseNotFound('Store Listing Not Found!');
            }

            return $store->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getStoreBySubCategoryId($store_subcategory_id = -1)
    {
        try {

            if ($store_subcategory_id == -1) {
                $paginator = Store::with('profile', 'profile_images',
                    'collage_image1', 'collage_image2', 'collage_image3',
                    'StoreFrontInfo', 'owner', 'BusinessInfo', 'Tags',
                    'StoreFrontPromotion', 'StoreFrontPromotion.image.image1',
                    'StoreFrontPromotion.image.image2', 'StoreFrontPromotion.image.image3',
                    'StoreFrontPromotion.image.image4', 'StoreCommerce', 'StoreStatus')
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('store_status')
                            ->whereRaw('stores.id = store_status.store_id')
                            ->whereRaw('store_status.status_id = 3');
                    })->orderBy('created_at', 'DESC')
                    ->paginate(10);
            } else {
                $paginator = Store::with('profile',
                    'profile_images', 'collage_image1', 'collage_image2', 'collage_image3',
                    'StoreFrontInfo', 'owner', 'BusinessInfo', 'Tags',
                    'StoreFrontPromotion', 'StoreFrontPromotion.image.image1',
                    'StoreFrontPromotion.image.image2', 'StoreFrontPromotion.image.image3',
                    'StoreFrontPromotion.image.image4', 'StoreCommerce', 'StoreStatus')
                    ->where('store_subcategory_id', $store_subcategory_id)
                    ->whereExists(function ($query) {
                        $query->select(DB::raw(1))
                            ->from('store_status')
                            ->whereRaw('stores.id = store_status.store_id')
                            ->whereRaw('store_status.status_id = 3');
                    })->orderBy('created_at', 'DESC')
                    ->paginate(10);
            }

            $allStores = $paginator->getCollection();

            if (!$allStores) {
                return $this->responseNotFound('Store Listing Not Found!');
            }

            $fractal = new Manager();

            $storesResource = new Collection($allStores, new StoreTransformer());

            $storesResource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            $data = $fractal->createData($storesResource);

            return $data->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @return mixed|string
     */
    public function searchStore()
    {
        try {

            $input = Input::all();

            $query = Store::with('profile', 'profile_images',
                'collage_image1', 'collage_image2', 'collage_image3',
                'StoreFrontInfo', 'owner', 'BusinessInfo', 'Tags',
                'StoreFrontPromotion', 'StoreFrontPromotion.image.image1',
                'StoreFrontPromotion.image.image2', 'StoreFrontPromotion.image.image3',
                'StoreFrontPromotion.image.image4', 'StoreCommerce', 'StoreStatus')
                ->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('store_status')
                        ->whereRaw('stores.id = store_status.store_id')
                        ->whereRaw('store_status.status_id = 3');
                });

            if (isset($input['searchKey'])) {
                $query->where('title', 'LIKE', '%' . $input['searchKey'] . '%');
            }

            if (isset($input['location'])) {
                $locationResource = App::make('LocationResource');

                $storeLocation = $locationResource->getLocationDetails($input['location']);

                $query->where('city', $storeLocation['city']);
            }

            if (isset($input['selectedStoreType'])) {
                $selectedStoreTypeIndex = $input['selectedStoreType']['Index'];

                $selectedStoreTypeIndex = +$selectedStoreTypeIndex + 1;

                if ($selectedStoreTypeIndex > 0) {
                    //This is a products store. Add query for only products store.

                    $query->whereExists(function ($query) use ($selectedStoreTypeIndex) {
                        $query->select(DB::raw(1))
                            ->from('store_front_info')
                            ->whereRaw('store_front_info.listing_type_id = ' . $selectedStoreTypeIndex);
                    });
                }
            }

            if (isset($input['selectedCategory'])) {
                $selectedCategoryId = $input['selectedCategory']['id'];

                //This is a products store. Add query for only products store.

                $query->where('store_category_id', $selectedCategoryId);

                $subcategories = $input['subCategories'];

                $subCatIdArray = array();

                foreach ($subcategories as $index => $subcategory) {
                    if (isset($subcategory['isChecked']) && $subcategory['isChecked']) {
                        array_push($subCatIdArray, $subcategory['id']);
                    }
                }

                if (!empty($subCatIdArray)) {
                    $query->whereIn('store_subcategory_id', $subCatIdArray);
                }
            }

            $paginator = $query->orderBy('created_at', 'DESC')->paginate(10);

            $allStores = $paginator->getCollection();

            if (!$allStores) {
                return $this->responseNotFound('Store Listing Not Found!');
            }

            $fractal = new Manager();

            $storesResource = new Collection($allStores, new StoreTransformer());

            $storesResource->setPaginator(new IlluminatePaginatorAdapter($paginator));

            $data = $fractal->createData($storesResource);

            return $data->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get all stores by user id
     * @param $user_id
     * @return mixed
     */
    public function getStoreByOwner($user_id)
    {
        try {
            $myStores = Store::with('profile', 'profile_images', 'collage_image1',
                'collage_image2', 'collage_image3', 'StoreFrontInfo',
                'owner', 'BusinessInfo', 'Tags', 'StoreFrontPromotion',
                'StoreFrontPromotion.image.image1', 'StoreFrontPromotion.image.image2',
                'StoreFrontPromotion.image.image3', 'StoreFrontPromotion.image.image4',
                'StoreCommerce', 'StoreStatus')
                ->where('owner_id', $user_id)->get();

            if (!$myStores) {
                return $this->responseNotFound('Store Listing Not Found!');
            }
            return $myStores->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getStoreByOwnerAndType($user_id, $storeType)
    {
        try {
            $myStores = Store::with('profile', 'profile_images', 'collage_image1', 'collage_image2', 'collage_image3', 'StoreFrontInfo', 'owner', 'BusinessInfo', 'Tags', 'StoreFrontPromotion', 'StoreFrontPromotion.image.image1', 'StoreFrontPromotion.image.image2', 'StoreFrontPromotion.image.image3', 'StoreFrontPromotion.image.image4', 'StoreCommerce', 'StoreStatus')->where('owner_id', $user_id)
                ->orWhereExists(function ($query) use ($storeType) {
                    $query->select(DB::raw(1))
                        ->from('store_front_info')
                        ->whereRaw('store_front_info.listing_type_id = ' . $storeType);
                })->get();

            if (!$myStores) {
                return $this->responseNotFound('Store Listing Not Found!');
            }
            return $myStores->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    public function getStoreByType($storeType)
    {
        try {
            $myStores = Store::with('profile', 'profile_images', 'collage_image1', 'collage_image2',
                'collage_image3', 'StoreFrontInfo', 'owner', 'BusinessInfo', 'Tags', 'StoreFrontPromotion',
                'StoreFrontPromotion.image.image1', 'StoreFrontPromotion.image.image2', 'StoreFrontPromotion.image.image3',
                'StoreFrontPromotion.image.image4', 'StoreCommerce', 'StoreStatus')
                ->orWhereExists(function ($query) use ($storeType) {
                    $query->select(DB::raw(1))
                        ->from('store_front_info')
                        ->whereRaw('store_front_info.listing_type_id = ' . $storeType);
                })->get();

            if (!$myStores) {
                return $this->responseNotFound('Store Listing Not Found!');
            }
            return $myStores->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Create classified request for information.
     * @param $store_id
     * @return mixed
     */
    public function createRequestQuote($store_id)
    {
        try {
            $input_array = Input::all();

            $locationResource = App::make('LocationResource');

            $storeId = $store_id;
            $name = $input_array['name'];
            $mobileNumber = $input_array['mobileNumber'];
            $email = $input_array['email'];
            $isContactEmail = isset($input_array['isContactEmail']) ?
                $input_array['isContactEmail'] : false;
            $isContactMobile = isset($input_array['isContactMobile']) ?
                $input_array['isContactMobile'] : false;

            $storeProducts = $input_array['enquiryProducts'];

            if (isset($input_array['city']))
                $enquiryLocation = $locationResource->getLocationDetails($input_array['city']);

            $classifiedEnquiryInfo = isset($input_array['otherInfo']) ?
                $input_array['otherInfo'] : '';
            $classifiedFeedback = isset($input_array['feedbackPurchase']) ?
                $input_array['feedbackPurchase'] : '';
            $classifiedComments = isset($input_array['comments']) ?
                $input_array['comments'] : '';

            $requestQuote = RequestQuote::create([
                'name' => $name,
                'mobile' => $mobileNumber,
                'email' => $email,
                'city' => !empty($enquiryLocation) ? $enquiryLocation['city'] : '',
                'is_contact_email' => $isContactEmail,
                'is_contact_phone' => $isContactMobile,
                'other_info' => $classifiedEnquiryInfo,
                'other_feedback' => $classifiedFeedback,
                'comment' => $classifiedComments
            ]);

            $storeRfq = StoreRfq::create([
                'rfq_id' => $requestQuote->id,
                'store_id' => $storeId
            ]);

            foreach ($storeProducts as $product) {
                $expectedDeliveryDate = $product['delivery_date'];
                $quantity = $product['quantity'];
                $expectedPurchaseDate = $product['purchase_date'];
                $productId = $product['id'];

                $deliveryLocation = null;

                if (isset($product['delivery_city']))
                    $deliveryLocation = $locationResource->getLocationDetails($product['delivery_city']);

                StoreProductRfq::create([
                    'rfq_id' => $storeRfq->id,
                    'product_id' => $productId,
                    'required_delivery_date' => $expectedDeliveryDate,
                    'required_quantity' => $quantity,
                    'likely_purchase_date' => $expectedPurchaseDate,
                    'delivery_city' => $deliveryLocation['city'],
                    'delivery_state' => $deliveryLocation['state'],
                    'delivery_country' => $deliveryLocation['country']
                ]);
            }

            // Send an invite email to classified owner notifying the rfi.

//            $store = StoreFrontInfo::find($storeId);
//
//            $storeId = $product->product_line->store->id;
//
//            $storeFrontInfo = StoreFrontInfo::where('store_id', $storeId)->first();
//
//            $user = array(
//                'email' => $email,
//                'name' => $name
//            );
//
//            $data = array(
//                'name' => $name,
//                'email' => $email,
//                'phone' => $mobileNumber,
//                'city' => !empty($enquiryLocation) ? $enquiryLocation['city'] : '',
//                'is_contact_email' => $isContactEmail == true ? 'Yes' : 'No',
//                'is_contact_phone' => $isContactMobile == true ? 'Yes' : 'No',
//                'other_info' => $classifiedEnquiryInfo,
//                'other_feedback' => $classifiedFeedback,
//                'comment' => $classifiedComments,
//            );
//
//            $emails = [$storeFrontInfo->store_contact_email, 'radhakrishnan.radha@gmail.com'];
//
//            Mail::send('emails.classifiedRfi', $data, function ($message) use ($user, $emails) {
//                $message->from($user['email'], $user['name']);
//                $message->to($emails, 'Product Enquiry')->subject('Evezown Product Request for Info!');
//            });

            $successResponse = [
                'status' => true,
                'id' => $storeRfq->id,
                'message' => 'Store request for quote submitted successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get products Rfi
     * @param $storeId
     * @return Exception|mixed|string
     */
    public function getProductsRfi($storeId)
    {
        try {
            $limit = Input::get('limit') ?: 10;

            $query = ProductRequestInfo::with('request_info');

            $query->whereIn('product_id', function ($query) use ($storeId) {
                $query->select('id')
                    ->from('products')
                    ->whereIn('product_line_id', function ($query) use ($storeId) {
                        $query->select('id')
                            ->from('product_line')
                            ->whereIn('store_id', [$storeId]);
                    });
            });

            $productsRfi = $query->orderBy('created_at', 'desc')->paginate($limit);

            if (!$productsRfi) {
                return $this->responseNotFound('No classified RFI exist!');
            }

            $fractal = new Manager();

            $classifiedsRfiResource = new Collection($productsRfi, new ProductsRfiTransformer());

            $classifiedsRfiResource->setPaginator(new IlluminatePaginatorAdapter($productsRfi));

            $data = $fractal->createData($classifiedsRfiResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

    public function getStoreRfq($storeId)
    {
        try {
            $limit = Input::get('limit') ?: 10;

            $query = StoreRfq::with('rfq', 'store_products.product');

            $query->where('store_id', $storeId);

            $storeRfq = $query->orderBy('created_at', 'desc')->paginate($limit);

            if (!$storeRfq) {
                return $this->responseNotFound('No store RFQ exist!');
            }

            $fractal = new Manager();

            $storeRfqResource = new Collection($storeRfq, new StoreRfqTransformer());

            $storeRfqResource->setPaginator(new IlluminatePaginatorAdapter($storeRfq));

            $data = $fractal->createData($storeRfqResource);

            return $data->toJson();
        } catch (Exception $e) {

            return $e;
        }
    }

}