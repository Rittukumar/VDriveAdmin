<?php

use Illuminate\Support\Facades\Mail;
use League\Fractal\Manager;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class ProductController extends AppController
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
            $title = $input_array['title'];
            $productLineType = $input_array['productLineType'];
            $description = $input_array['description'];
            $storeId = $input_array['storeId'];
            try {
                $productLine = ProductLine::create([
                    'title' => $title,
                    'description' => $description,
                    'type' => $productLineType,
                    'store_id' => $storeId,
                ]);
            } catch (Exception $ex) {
                return $ex;
            }
            $successResponse = [
                'status' => true,
                'id' => $productLine->id,
                'message' => 'Product Line created successfully!'
            ];


            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     * POST /AddProduct
     *
     * @return Response
     */
    public function AddProduct()
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];

            //For Products Table
            $title = $input_array['productTitle'];
            $productLineTypeId = $input_array['productLineTypeId'];
            $description = $input_array['description'];

            try {
                $product = Product::create([
                    'title' => $title,
                    'description' => $description,
                    'product_line_id' => $productLineTypeId
                ]);
            } catch (Exception $ex) {
                return $ex;
            }


            $productId = $product->id;

            //For SKU Table

            $productPrice = $input_array['productPrice'];
            if (isset($input_array['productDiscount'])) {
                $productDiscount = $input_array['productDiscount'];
            } else {
                $productDiscount = "0";
            }
            if (isset($input_array['productShipmentCharge'])) {
                $productShipmentCharge = $input_array['productShipmentCharge'];
            } else {
                $productShipmentCharge = "0";
            }
            if (isset($input_array['productSize'])) {
                $productSize = $input_array['productSize'];
            } else {
                $productSize = "NA";
            }
            if (isset($input_array['productColor'])) {
                $productColor = $input_array['productColor'];
            } else {
                $productColor = "NA";
            }

            if (isset($input_array['productWeight'])) {
                $productWeight = $input_array['productWeight'];
            } else {
                $productWeight = "NA";
            }

            if (isset($input_array['productVolume'])) {
                $productVolume = $input_array['productVolume'];
            } else {
                $productVolume = "NA";
            }

            if (isset($input_array['productPackingDate'])) {
                $productPackingDate = $input_array['productPackingDate'];
            } else {
                $productPackingDate = "NA";
            }
            if (isset($input_array['productExpiryDate'])) {
                $productExpiryDate = $input_array['productExpiryDate'];
            } else {
                $productExpiryDate = "NA";
            }
            try {
                $productSKU = ProductSKU::create([
                    'product_id' => $productId,
                    'price' => $productPrice,
                    'discount' => $productDiscount,
                    'shipping_charge' => $productShipmentCharge,
                    'size' => $productSize,
                    'color' => $productColor,
                    'weight' => $productWeight,
                    'volume' => $productVolume
                ]);
            } catch (Exception $ex) {
                return $ex;
            }


            $productSKUId = $productSKU->id;

            if (isset($input_array['productImages'])) {
                //Product Images
                $productImages = $input_array['productImages'];
                foreach ($productImages as $imageName) {
                    $image = EvezownImage::create([
                            'large_image_url' => $imageName
                        ]
                    );

                    $productImage = ProductImages::create([
                        'product_sku_id' => $productSKUId,
                        'product_image_id' => $image['id']
                    ]);
                }
            }

            //For Stock Table
            if (isset($input_array['productStock'])) {
                $productStock = $input_array['productStock'];
            } else {
                $productStock = "0";
            }

            try {
                $productStock = ProductStock::create([
                    'product_sku_id' => $productSKUId,
                    'quantity' => $productStock
                ]);
            } catch (Exception $ex) {
                return $ex;
            }


            $successResponse = [
                'status' => true,
                'id' => $product->id,
                'message' => 'Product created successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Store a newly created resource in storage.
     * POST /AddProduct
     *
     * @return Response
     */
    public function AddProductSKU($productId)
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];


            $productId = $productId;

            //For SKU Table

            $productPrice = $input_array['productPrice'];
            if (isset($input_array['productDiscount'])) {
                $productDiscount = $input_array['productDiscount'];
            } else {
                $productDiscount = "0";
            }
            if (isset($input_array['productShipmentCharge'])) {
                $productShipmentCharge = $input_array['productShipmentCharge'];
            } else {
                $productShipmentCharge = "0";
            }
            if (isset($input_array['productSize'])) {
                $productSize = $input_array['productSize'];
            } else {
                $productSize = "";
            }
            if (isset($input_array['productColor'])) {
                $productColor = $input_array['productColor'];
            } else {
                $productColor = "";
            }

            if (isset($input_array['productWeight'])) {
                $productWeight = $input_array['productWeight'];
            } else {
                $productWeight = "";
            }

            if (isset($input_array['productVolume'])) {
                $productVolume = $input_array['productVolume'];
            } else {
                $productVolume = "";
            }

            if (isset($input_array['productPackingDate'])) {
                $productPackingDate = $input_array['productPackingDate'];
            } else {
                $productPackingDate = "";
            }
            if (isset($input_array['productExpiryDate'])) {
                $productExpiryDate = $input_array['productExpiryDate'];
            } else {
                $productExpiryDate = "";
            }
            try {
                $productSKU = ProductSKU::create([
                    'product_id' => $productId,
                    'price' => $productPrice,
                    'discount' => $productDiscount,
                    'shipping_charge' => $productShipmentCharge,
                    'size' => $productSize,
                    'color' => $productColor,
                    'weight' => $productWeight,
                    'volume' => $productVolume
                ]);
            } catch (Exception $ex) {
                return $ex;
            }


            $productSKUId = $productSKU->id;

            if (isset($input_array['productImages'])) {
                //Product Images
                $productImages = $input_array['productImages'];
                foreach ($productImages as $imageName) {
                    $image = EvezownImage::create([
                            'large_image_url' => $imageName
                        ]
                    );

                    $productImage = ProductImages::create([
                        'product_sku_id' => $productSKUId,
                        'product_image_id' => $image['id']
                    ]);
                }
            }

            //For Stock Table
            if (isset($input_array['productStock'])) {
                $productStock = $input_array['productStock'];
            } else {
                $productStock = "0";
            }

            try {
                $productStock = ProductStock::create([
                    'product_sku_id' => $productSKUId,
                    'quantity' => $productStock
                ]);
            } catch (Exception $ex) {
                return $ex;
            }


            $successResponse = [
                'status' => true,
                'id' => $productSKUId,
                'message' => 'Product variant created successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Update resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function UpdateProduct($productId)
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];

            //For Products Table
            $title = $input_array['productTitle'];
            $productLineTypeId = $input_array['productLineTypeId'];
            $description = $input_array['description'];
            $product = Product::find($productId);

            try {

                if (isset($input_array['productTitle'])) {
                    $product->title = $title;
                }
                if (isset($input_array['description'])) {
                    $product->description = $description;
                }
                if (isset($input_array['productLineTypeId'])) {
                    $product->product_line_id = $productLineTypeId;
                }
                $product->save();

            } catch (Exception $ex) {
                return $ex;
            }
            $productId = $product->id;
            $successResponse = [
                'status' => true,
                'id' => $productId,
                'message' => 'Product updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Update resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function UpdateProductSKU($productSKUId)
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];


            $productSKU = ProductSKU::find($productSKUId);
            if (isset($input_array['productPrice'])) {
                $productSKU->price = $input_array['productPrice'];
            }
            if (isset($input_array['productDiscount'])) {
                $productSKU->discount = $input_array['productDiscount'];
            }

            if (isset($input_array['productShipmentCharge'])) {
                $productSKU->shipping_charge = $input_array['productShipmentCharge'];
            }

            if (isset($input_array['productSize'])) {
                $productSKU->size = $input_array['productSize'];
            }

            if (isset($input_array['productColor'])) {
                $productSKU->color = $input_array['productColor'];
            }

            if (isset($input_array['productWeight'])) {
                $productSKU->weight = $input_array['productWeight'];
            }


            if (isset($input_array['productVolume'])) {
                $productSKU->volume = $input_array['productVolume'];
            }


            if (isset($input_array['productImages'])) {
                //Product Images
                $productImages = $input_array['productImages'];
                foreach ($productImages as $imageName) {
                    $image = EvezownImage::create([
                            'large_image_url' => $imageName
                        ]
                    );

                    $productImage = ProductImages::create([
                        'product_sku_id' => $productSKU->id,
                        'product_image_id' => $image['id']
                    ]);
                }
            }

//            if(isset($input_array['productPackingDate'])) {
//                $productSKU->volume = $input_array['productPackingDate'];
//            }
//            else {
//                $productPackingDate = "NA";
//            }
//            if(isset($input_array['productExpiryDate'])) {
//                $productExpiryDate = $input_array['productExpiryDate'];
//            }
//            else {
//                $productExpiryDate = "NA";
//            }


            $productSKU->save();
            $productSKUId = $productSKU->id;

            $successResponse = [
                'status' => true,
                'id' => $productSKUId,
                'message' => 'Product updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Update resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function UpdateProductStock($productSKUId)
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];

            $productStock = ProductStock::find($productSKUId);
            if (isset($input_array['productStock'])) {
                $productStock->quantity = $input_array['productStock'];
            }
            $productStock->save();
            $successResponse = [
                'status' => true,
                'id' => $productSKUId,
                'message' => 'Product stock updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

//update trending product =

    /**
     * Update resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function UpdateTrendingProduct($productSKUId)
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];

            $trendingProduct = TrendingProducts::where('product_sku_id', $productSKUId)->first();

            if ($trendingProduct) {
                $selectedSKU = ProductSKU::where('id', $productSKUId)->first();
                if (isset($input_array['isTrending'])) {
                    $selectedSKU->is_trending = $input_array['isTrending'];
                    $selectedSKU->save();
                }
                $trendingProduct->delete();
            } else {
                $allSkU = TrendingProducts::where('store_id', $input_array['storeId'])->get();
                if (count($allSkU) < 4) {
                    $selectedSKU = ProductSKU::where('id', $productSKUId)->first();
                    if (isset($input_array['isTrending'])) {
                        $selectedSKU->is_trending = $input_array['isTrending'];
                        $selectedSKU->save();
                    }
                    $trending = TrendingProducts::create([
                        'product_sku_id' => $productSKUId,
                        'store_id' => $input_array['storeId']
                    ]);
                } else {
                    $failureResponse = [
                        'status' => true,
                        'message' => 'Already have 4 items as trending products!'
                    ];

                    return $this->setStatusCode(500)->respondWithError($failureResponse);
                }


            }

            $successResponse = [
                'status' => true,
                'id' => $productSKUId,
                'message' => 'trending products updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * add resource in storage.
     * POST /AddProductImages
     *
     * @return Response
     */
    public function AddProductImages($productSKUId)
    {
        try {
            $input = Input::all();
            $input_array = $input['data'];

            if (isset($input_array['productImages'])) {
                //Product Images
                $productImages = $input_array['productImages'];
                foreach ($productImages as $imageName) {
                    $image = EvezownImage::create([
                            'large_image_url' => $imageName
                        ]
                    );

                    $productImage = ProductImages::create([
                        'product_sku_id' => $productSKUId,
                        'product_image_id' => $image['id']
                    ]);
                }
            }

            $successResponse = [
                'status' => true,
                'id' => $productSKUId,
                'message' => 'Product Images added successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Delete resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function DeleteProductImages($productImageId)
    {
        try {
            $productImage = ProductImages::where('product_image_id', $productImageId)->first();

            if (!$productImage) {
                return $this->responseNotFound('Product Image Not Found!');
            }
            $productImage->delete();
            $successResponse = [
                'status' => true,
                'message' => 'Product Image removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);


        } catch (Exception $e) {

            return $e;
        }
    }


    /**
     * Delete resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function DeleteProduct($productId)
    {
        try {

            $product = Product::find($productId);

            if (!$product) {
                return $this->responseNotFound('Product Not Found!');
            }

            $productSKU = ProductSKU::where('product_id', $productId);

            foreach ($productSKU as $sku) {
                $productImage = ProductImages::where('product_sku_id', $sku->id);
                foreach ($productImage as $image) {
                    $image->delete();
                }
                $productStock = ProductStock::where('product_sku_id', $sku->id)->first();
                $productStock->delete();
                $sku->delete();
            }

            $product->delete();
            $successResponse = [
                'status' => true,
                'message' => 'Product removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);


        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Delete resource in storage.
     * POST /UpdateProduct
     *
     * @return Response
     */
    public function DeleteProductSKU($productSKUId)
    {
        try {

            $productSKU = ProductSKU::find($productSKUId);

            if (!$productSKU) {
                return $this->responseNotFound('Product Not Found!');
            }

            $productImage = ProductImages::where('product_sku_id', $productSKUId)->get();
            foreach ($productImage as $image) {
                $image->delete();
            }
            $productStock = ProductStock::where('product_sku_id', $productSKUId)->first();
            $productStock->delete();
            $productSKU->delete();
            $successResponse = [
                'status' => true,
                'message' => 'Product removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);


        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Get All products
     * POST /get
     *
     * @return Response
     */
    public function getAllProducts($productlineId)
    {
        try {
            $products = Product::with('ProductSKU', 'ProductSKU.ProductImages.image', 'ProductSKU.ProductStock')
                ->where('product_line_id', $productlineId)->get();

            if (!$products) {
                return $this->responseNotFound('Products Not Found!');
            }
            return $products->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * search products
     * POST /get
     *
     * @return Response
     */
    public function searchProduct($searchkey)
    {
        try {
            $limit = Input::get('limit') ?: 12;

            $products = Product::with('ProductSKU', 'ProductSKU.ProductImages.image', 'ProductSKU.ProductStock')
                ->where('title', 'LIKE', "%$searchkey%")->paginate($limit);

            if (!$products) {
                return $this->responseNotFound('Products Not Found!');
            }
            return $products->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get product by id
     * POST /get
     *
     * @return Response
     */
    public function getProductById($productId)
    {
        try {
            $products = Product::with('ProductSKU', 'ProductSKU.ProductImages.image',
                'ProductSKU.ProductStock', 'ProductLine.store')->where('id', $productId)->get();

            if (!$products) {
                return $this->responseNotFound('Products Not Found!');
            }
            return $products->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Get product by product line id
     * POST /get
     *
     * @return Response
     */
    public function getProductsByProductLineId($productLineId)
    {
        try {
            $products = Product::with('ProductSKU', 'ProductSKU.ProductImages.image',
                'ProductImages.ProductStock')->where('product_line_id', $productLineId)->get();

            if (!$products) {
                return $this->responseNotFound('Products Not Found!');
            }
            return $products->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Get product by product line id
     * POST /get
     *
     * @return Response
     */
    public function getProductSKUByProductId($productId)
    {
        try {
            $productSKU = ProductSKU::with('ProductImages.image', 'ProductStock')->where('product_id', $productId)->get();

            if (!$productSKU) {
                return $this->responseNotFound('Products Not Found!');
            }
            return $productSKU->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get All productlines under a store.
     * POST /get
     *
     * @return Response
     */
    public function getProductLineByStoreId($storeId)
    {
        try {
            $productLines = ProductLine::with('products.ProductSKU.ProductImages.image', 'products.ProductSKU.ProductStock')
                ->where('store_id', $storeId)->get();

            if (!$productLines) {
                return $this->responseNotFound('Product Lines Not Found!');
            }
            return $productLines->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Get All productlines under a store.
     * POST /get
     *
     * @param $productlineId
     * @return Response
     */
    public function getProductLine($productlineId)
    {
        try {
            $productLines = ProductLine::with('store.profile_images',
                'products.ProductSKU.ProductImages.image',
                'products.ProductSKU.ProductStock')
                ->find($productlineId);

            if (!$productLines) {
                return $this->responseNotFound('Product Lines Not Found!');
            }
            return $productLines->toJson();

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Load variants based on the selection made.
     * @param $productId
     * @return mixed
     */
    public function getProductVariants($productId)
    {
        try {
            $input_array = Input::all();

            $productSkusQuery = ProductSKU::with('ProductImages.image', 'ProductStock', 'product.ProductLine.store')->where('product_id', $productId);

            if (isset($input_array['color']) && $input_array['color'] != "") {
                $productSkusQuery->where('color', $input_array['color']);
            }

            if (isset($input_array['size']) && $input_array['size'] != "") {
                $productSkusQuery->where('size', $input_array['size']);
            }

            if (isset($input_array['volume']) && $input_array['volume'] != "") {
                $productSkusQuery->where('volume', $input_array['volume']);
            }

            if (isset($input_array['weight']) && $input_array['weight'] != "") {
                $productSkusQuery->where('weight', $input_array['weight']);
            }

            $productSkus = $productSkusQuery->get();

            $fractal = new Manager();

            $productSkusResource = new Collection($productSkus, new ProductSkuTransformer());

            return $fractal->createData($productSkusResource)->toJson();

        } catch (Exception $ex) {
            return $this->setStatusCode(500)->respondWithError($ex);
        }

    }

    /**
     * Create classified request for information.
     * @param $product_id
     * @return mixed
     */
    public function createRequestInfo($product_id)
    {
        try {
            $input_array = Input::all();

            $productId = $product_id;
            $name = $input_array['name'];
            $mobileNumber = $input_array['mobileNumber'];
            $email = $input_array['email'];

            $isContactEmail = isset($input_array['isContactEmail']) ? $input_array['isContactEmail'] : false;
            $isContactMobile = isset($input_array['isContactMobile']) ? $input_array['isContactMobile'] : false;
            $expectedDeliveryDate = $input_array['expectedDeliveryDate'];
            $quantity = $input_array['quantity'];
            $expectedPurchaseDate = $input_array['expectedPurchaseDate'];

            $classifiedEnquiryInfo = isset($input_array['otherInfo']) ? $input_array['otherInfo'] : '';
            $classifiedFeedback = isset($input_array['feedbackPurchase']) ? $input_array['feedbackPurchase'] : '';
            $classifiedComments = isset($input_array['comments']) ? $input_array['comments'] : '';

            if (isset($input_array['city']))
                $enquiryLocation = $this->getLocationDetails($input_array['city']);

            if (isset($input_array['deliveryLocation']))
                $deliveryLocation = $this->getLocationDetails($input_array['deliveryLocation']);


            $requestInfo = RequestInfo::create([
                'name' => $name,
                'mobile' => $mobileNumber,
                'email' => $email,
                'city' => !empty($enquiryLocation) ? $enquiryLocation['city'] : '',
                'required_delivery_date' => $expectedDeliveryDate,
                'required_quantity' => $quantity,
                'likely_purchase_date' => $expectedPurchaseDate,
                'delivery_city' => !empty($deliveryLocation) ? $deliveryLocation['city'] : '',
                'delivery_state' => !empty($deliveryLocation) ? $deliveryLocation['state'] : '',
                'delivery_country' => !empty($deliveryLocation) ? $deliveryLocation['country'] : '',
                'is_contact_email' => $isContactEmail,
                'is_contact_phone' => $isContactMobile,
                'other_info' => $classifiedEnquiryInfo,
                'other_feedback' => $classifiedFeedback,
                'comment' => $classifiedComments
            ]);

            $productRequestInfo = ProductRequestInfo::create([
                'rfi_id' => $requestInfo->id,
                'product_id' => $productId
            ]);

            // Send an invite email to classified owner notifying the rfi.

            $product = Product::with('ProductLine.store')->find($product_id);

            $storeId = $product->product_line->store->id;

            $storeFrontInfo = StoreFrontInfo::where('store_id', $storeId)->first();

            if ($storeFrontInfo && $storeFrontInfo->store_contact_email) {
                $user = array(
                    'email' => $email,
                    'name' => $name
                );

                $data = array(
                    'name' => $name,
                    'email' => $email,
                    'phone' => $mobileNumber,
                    'city' => !empty($enquiryLocation) ? $enquiryLocation['city'] : '',
                    'is_contact_email' => $isContactEmail == true ? 'Yes' : 'No',
                    'is_contact_phone' => $isContactMobile == true ? 'Yes' : 'No',
                    'other_info' => $classifiedEnquiryInfo,
                    'other_feedback' => $classifiedFeedback,
                    'comment' => $classifiedComments,
                );

                $emails = [$storeFrontInfo->store_contact_email, 'radhakrishnan.radha@gmail.com'];

                Mail::send('emails.classifiedRfi', $data, function ($message) use ($user, $emails) {
                    $message->from($user['email'], $user['name']);
                    $message->to($emails, 'Product Enquiry')->subject('Evezown Product Request for Info!');
                });
            }

            $successResponse = [
                'status' => true,
                'id' => $productRequestInfo->id,
                'message' => 'Product request for info submitted successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * GET /register/{id}/edit
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * PUT /register/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {

        try {
            $input = Input::all();
            $input_array = $input['data'];
            $title = $input_array['title'];
            $productLineType = $input_array['productLineType'];
            $description = $input_array['description'];
            //
            $productLine = ProductLine::find($id);
            $productLine->title = $title;
            $productLine->description = $description;
            $productLine->type = $productLineType;

            $productLine->save();

            $successResponse = [
                'status' => true,
                'id' => $productLine->id,
                'message' => 'Product line updated successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);
        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }


    /**
     * Remove the specified resource from storage.
     * DELETE /register/{id}
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        try {
            $productLine = ProductLine::where('id', $id)->first();

            if (!$productLine) {
                return $this->responseNotFound('Product Lines Not Found!');
            }
            $productLine->delete();
            $successResponse = [
                'status' => true,
                'message' => 'Product line removed successfully!'
            ];

            return $this->setStatusCode(200)->respond($successResponse);

        } catch (Exception $e) {

            return $this->setStatusCode(500)->respondWithError($e);
        }
    }

    /**
     * @param $input_array
     * @return mixed
     */
    private function getLocationDetails($location)
    {
        $locationArray = array(
            'city' => '',
            'state' => '',
            'country' => ''
        );

        // Parse the google location details for enquiry city.

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
                                $locationArray['state'] = $a['long_name'];
                            }
                            if ($a['types'][0] == 'country') {
                                $locationArray['country'] = $a['long_name'];
                            }
                            if ($a['types'][0] == 'locality') {
                                $locationArray['city'] = $a['long_name'];
                            }
                        }
                    }
                }
                return $locationArray;
            }
            return $locationArray;
        }
        return $locationArray;
    }

}