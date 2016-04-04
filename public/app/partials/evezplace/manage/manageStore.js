/**
 * Created by Viswanathan on 7/15/2015.
 */

evezownApp
    .controller('ManageStoreCtrl', function ($scope, $routeParams,$timeout,$cookieStore,$controller, $location,
                                             ngTableParams,$rootScope,$http,PATHS,ngDialog,FileUploader) {

        // This count is dynamic based on selection of store type.

        $scope.selectedProductLineType = null;
        $scope.productImages = [];
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.service_url = PATHS.api_url;
        $rootScope.AllProductLines = [];
        //$rootScope.currentProductLine = null;
        $scope.isImageUploadComplete = false;
        $scope.isAddProductHidden = false;
        $scope.isProductSKUHidden = false;
       // $rootScope.selectedProductLine = null;

        $scope.prodPrice=0;
        $scope.prodShipment=0;
        $scope.prodDiscount=0;
        
        $scope.AllProducts = [];
        $scope.productImages = [];
        $rootScope.AllProductSKU = [];
        $scope.storeCommerce = {wantPaymentGateway : null,billingAddress:null,billingPincode:null,cityStateCountry:null,
            isOffline:null,isCod:null,isChequePayment:null,contactNumber:null,vendorName:null,additionalInfo:null};

        //$rootScope.currentProduct = null;
        $scope.showAddVariant = false;
        $scope.showvariantlist = false;
        $scope.productLineTypes = [
            {
                id: 0,
                name: 'Product'
            },
            {
                id: 1,
                name: 'Services'
            }];
        $rootScope.selectedType = $scope.productLineTypes[0];
        $scope.productCount = 48;

        if($routeParams.id)
        {
            $rootScope.currentStoreId = $routeParams.id;
        }
        else if($routeParams.storeId)
        {
            $rootScope.currentStoreId = $routeParams.storeId;
        }


        $scope.ShowAddProduct = function()
        {
            $scope.isAddProductHidden = true;
            $scope.isProductSKUHidden = false;
        }
        $scope.HideAddProduct = function()
        {
            $scope.isAddProductHidden = false;
        }
        $scope.GetCurrentStore = function() {
            if ($rootScope.currentStoreId != undefined) {
                //stores/{store_id}/get
                $http.get(PATHS.api_url + 'stores/' + $rootScope.currentStoreId + '/get').
                    success(function (data) {
                        $scope.currentStore = data;
                        if ($scope.currentStore.length > 0) {


                            $scope.storeCommerce.wantPaymentGateway = $scope.currentStore[0]['store_commerce']['is_payment_gateway_needed'];
                            $scope.storeCommerce.billingAddress = $scope.currentStore[0]['store_commerce']['billing_address'];
                            $scope.storeCommerce.billingPincode = $scope.currentStore[0]['store_commerce']['billing_pincode'];
                            $scope.storeCommerce.cityStateCountry = $scope.currentStore[0]['store_commerce']['billing_city'] +','+ $scope.currentStore[0]['store_commerce']['billing_state']+','+ $scope.currentStore[0]['store_commerce']['billing_country'];
                            $scope.storeCommerce.isOffline = $scope.currentStore[0]['store_commerce']['is_offline_payment'];
                            $scope.storeCommerce.isCod = $scope.currentStore[0]['store_commerce']['is_cash_delivery'];
                            $scope.storeCommerce.isChequePayment = $scope.currentStore[0]['store_commerce']['is_cheque_payment'];
                            $scope.storeCommerce.contactNumber = $scope.currentStore[0]['store_commerce']['contact_number'];
                            $scope.storeCommerce.vendorName = $scope.currentStore[0]['store_commerce']['vendor_name'];
                            $scope.storeCommerce.additionalInfo = $scope.currentStore[0]['store_commerce']['additional_info'];
                        }

                    });
            }
        }

        $scope.SetProductLine = function(productLine)
        {
            $rootScope.selectedProductLine = productLine;
        }

        $scope.AddProductLine = function (formData)
        {
            if(formData)
            {
                if(!formData.productLineTitle)
                {
                    toastr.error('Please enter a title', 'Store');
                }
                else if(!formData.productLineDesc)
                {
                    toastr.error('Please enter description', 'Store');
                }
                else if(!$scope.selectedProductLineType)
                {
                    toastr.error('Please select a product line type', 'Store');
                }
                else
                {
                    $http.post(PATHS.api_url + 'stores/productline/store'
                        , {
                            data:
                            {
                                storeId: $rootScope.currentStoreId,
                                title:formData.productLineTitle,
                                description:formData.productLineDesc,
                                productLineType:$scope.selectedProductLineType.id
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                        success(function (data, status, headers, config)
                        {
                            toastr.success(data.message, 'Store');

                        }).error(function (data)
                        {
                            toastr.error(data.error.message, 'Store');
                        }).then(function()
                        {
                            formData.productLineTitle = "";
                            formData.productLineDesc = "";
                            $scope.selectedProductLineType = null;
                            $scope.productLineTypes = [
                                {
                                    id: 0,
                                    name: 'Product'
                                },
                                {
                                    id: 1,
                                    name: 'Services'
                                }];
                            $scope.GetProductLine();
                        });
                }
            }
            else
            {
                toastr.error('Please enter a product title', 'Store');
            }


        }

        $scope.UpdateTrending = function(productSKU)
        {
            $http.post(PATHS.api_url + 'stores/product/trendingproduct/'+productSKU.id+'/update'
                , {
                    data:
                    {
                        isTrending:productSKU.is_trending,
                        storeId :$rootScope.currentStoreId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Store');
                }).error(function (data)
                {
                    productSKU.is_trending = false;
                    toastr.error(data.error.message.message, 'Store');
                }).then(function()
                {

                });
        }

        $scope.EnablePaymentGateWay = function(storeCommerce)
        {

            /*if(!storeCommerce.wantPaymentGateway)
            {
                toastr.success("Please select payment gateway option", 'Store');
            }*/
            if(!storeCommerce.billingAddress)
            {
                toastr.success("Please enter billing address", 'Store');
            }
            else if(!storeCommerce.cityStateCountry)
            {
                toastr.success("Please choose location", 'Store');
            }
            else if(!storeCommerce.cityStateCountry)
            {
                toastr.success("Please enter 6 digits pincode", 'Store');
            }
            else
            {
                $http.post(PATHS.api_url + 'users/store/commerce/'+$scope.loggedInUserId+'/add'
                    , {
                        data:
                        {
                            StoreId:$rootScope.currentStoreId,
                            isGateWayNeeded :storeCommerce.wantPaymentGateway,
                            address :storeCommerce.billingAddress,
                            cityStateCountry :storeCommerce.cityStateCountry,
                            pincode :storeCommerce.billingPincode

                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                    success(function (data, status, headers, config)
                    {
                        toastr.success(data.message, 'Store');
                    }).error(function (data)
                    {
                        toastr.error(data.error.message, 'Store');
                    }).then(function()
                    {

                    });
            }
        }

        $scope.SaveStoreCommerce = function(storeCommerce)
        {
            if(!storeCommerce.contactNumber)
            {
                toastr.success("Please contact number", 'Store');
            }
            else if(!storeCommerce.vendorName)
            {
                toastr.success("Please enter vendor name", 'Store');
            }
            else
            {
                $http.post(PATHS.api_url + 'users/store/commerce/'+$scope.loggedInUserId+'/add'
                    , {
                        data:
                        {
                            StoreId:$rootScope.currentStoreId,
                            isOffline :storeCommerce.isOffline,
                            isCashOnDelivery :storeCommerce.isCod,
                            isChequePayment :storeCommerce.isChequePayment,
                            contactNumber :storeCommerce.contactNumber,
                            vendorName :storeCommerce.vendorName,
                            additionalInfo :storeCommerce.additionalInfo

                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                    success(function (data, status, headers, config)
                    {
                        toastr.success(data.message, 'Store');
                    }).error(function (data)
                    {
                        toastr.error(data.error.message, 'Store');
                    }).then(function()
                    {

                    });
            }
        }

        $scope.SetProductLineType = function(productLineType)
        {
            $scope.selectedProductLineType = productLineType;
        }

        $scope.GetProductLine = function ()
        {
            $http.get(PATHS.api_url + 'stores/productline/'+$rootScope.currentStoreId+'/get').
                success(function (data, status, headers, config)
                {
                    $rootScope.AllProductLines = data;

                }).error(function (data)
                {
                    console.log(data);
                });
        }

        $scope.SelectProductLine =  function(productLine)
        {
            $scope.GetProducts(productLine);
        }

        $scope.GetProducts = function (productLine)
        {
            $rootScope.selectedProductLine = productLine;
            $rootScope.currentProductLine = productLine;
            $http.get(PATHS.api_url + 'stores/productline/products/'+productLine.id+'/get').
                success(function (data, status, headers, config)
                {
                    $scope.AllProducts = data;

                }).error(function (data)
                {
                    console.log(data);
                });
        }

        $scope.GetProductSKU = function (product)
        {
            //stores/products/sku/{productId}/get
            $rootScope.currentSelectedProduct = product;
            $scope.showvariantlist = true;
            $scope.showAddVariant = false;
            $http.get(PATHS.api_url + 'stores/products/sku/'+product.id+'/get').
                success(function (data, status, headers, config)
                {
                    $rootScope.AllProductSKU = data;

                }).error(function (data)
                {
                    console.log(data);
                });
        }

        /*$scope.SaveProductLine = function(formData)
        {
            if(formData)
            {
                if(!formData.title)
                {
                    toastr.error('Please enter a title', 'Store');
                }
                else if(!formData.description)
                {
                    toastr.error('Please enter description', 'Store');
                }
                else if(!$rootScope.selectedType)
                {
                    toastr.error('Please select a product line type', 'Store');
                }
                else
                {

                    $http.post(PATHS.api_url + 'stores/productline/'+$rootScope.selectedProductLine.id+'/update'
                        , {
                            data:
                            {
                                title:formData.title,
                                description:formData.description,
                                productLineType:$rootScope.selectedType.id
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                        success(function (data, status, headers, config)
                        {
                            toastr.success(data.message, 'Store');
                            ngDialog.close();

                        }).error(function (data)
                        {
                            toastr.error(data.error.message, 'Store');
                        }).then(function()
                        {
                            $rootScope.selectedType = null;
                            formData.title = "";
                            formData.description = "";
                            $scope.GetProductLine();
                        });
                }
            }
            else
            {
                toastr.error('Please enter a store title', 'Store');
            }

        }*/

        $scope.SaveProduct = function(formData)
        {
            if(formData)
            {
                if(!formData.productTitle)
                {
                    toastr.error('Please enter a product title', 'Store');
                }
                else if(!$rootScope.selectedProductLine)
                {
                    toastr.error('Please select a product line', 'Store');
                }
                else if(!formData.productDescription)
                {
                    toastr.error('Please enter a product description', 'Store');
                }
                else if(!formData.productPrice)
                {
                    toastr.error('Please enter a product price', 'Store');
                }
                else
                {
                    if($scope.isImageUploadComplete)
                    {
                        $http.post(PATHS.api_url + 'stores/product/add'
                            , {
                                data:
                                {
                                    productTitle:formData.productTitle,
                                    productLineTypeId:$rootScope.selectedProductLine.id,
                                    description:formData.productDescription,
                                    productPrice:formData.productPrice,
                                    productDiscount:formData.productDiscount,
                                    productShipmentCharge:formData.productShipmentCharges,
                                    productSize:formData.productSize,
                                    productColor:formData.productColor,
                                    productWeight:formData.productWeight,
                                    productVolume:formData.productVolume,
                                    productPackingDate:formData.productExpiry,
                                    productExpiryDate:formData.productExpiry,
                                    productImages:$scope.productImages,
                                    productStock:formData.productStock

                                },
                                headers: {'Content-Type': 'application/json'}
                            }).
                            success(function (data, status, headers, config)
                            {
                                toastr.success(data.message, 'Store');
                                ngDialog.close();
                                //making all fields of the form to null after success
                                formData.productTitle = "";
                                formData.productDiscount = "";
                                formData.productPrice = "";
                                formData.productShipmentCharges = "";
                                formData.productSize = "";
                                formData.productColor = "";
                                formData.productWeight = "";
                                formData.productVolume = "";
                                formData.productExpiry = "";
                                formData.productDescription = "";
                                formData.productStock = "";
                                $scope.productImages = [];
                                $scope.isImageUploadComplete = false;
                                
                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Store');
                            }).then(function()
                            {
                                $scope.isAddProductHidden = false;
                                $scope.GetProducts($scope.selectedProductLineType);
                            });
                    }
                    else
                    {
                        toastr.error('Please add a product image', 'Store');
                    }

                }
            }
            else
            {
                toastr.error('Please enter a product title', 'Store');
            }

        }

        $scope.AddProductSKU = function(formData)
        {
            if(formData)
            {
                if(!formData.productPrice)
                {
                    toastr.error('Please enter a product price', 'Store');
                }
                else
                {
                    if($scope.isImageUploadComplete)
                    {

                        $http.post(PATHS.api_url + 'stores/product/productSKU/'+$rootScope.currentProduct.id+'/add'
                            , {
                                data:
                                {
                                    productDiscount:formData.productDiscount,
                                    productPrice:formData.productPrice,
                                    productShipmentCharge:formData.productShipmentCharges,
                                    productSize:formData.productSize,
                                    productColor:formData.productColor,
                                    productWeight:formData.productWeight,
                                    productVolume:formData.productVolume,
                                    productPackingDate:formData.productExpiry,
                                    productExpiryDate:formData.productExpiry,
                                    productImages:$scope.productImages,
                                    productStock:formData.productStock

                                },
                                headers: {'Content-Type': 'application/json'}
                            }).
                            success(function (data, status, headers, config)
                            {
                                toastr.success(data.message, 'Store');
                                $scope.showAddVariant = false;
                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Store');
                            }).then(function()
                            {
                                $rootScope.currentProduct = null;
                                formData.productDiscount = "";
                                formData.productPrice = "";
                                formData.productShipmentCharges = "";
                                formData.productSize = "";
                                formData.productColor = "";
                                formData.productWeight = "";
                                formData.productVolume = "";
                                formData.productExpiry = "";
                                formData.productExpiry = "";
                                formData.productStock = "";
                                $scope.productImages = [];
                                $scope.isImageUploadComplete = false;
                                $scope.GetProducts($rootScope.selectedProductLine);
                            });
                    }
                    else
                    {
                        toastr.error('Please add a product image', 'Store');
                    }

                }
            }
            else
            {
                toastr.error('Please enter a product title', 'Store');
            }

        }

        $scope.ViewProducts = function(productline)
        {
            $scope.isAddProductHidden = false;
            $scope.isProductSKUHidden = true;
            $scope.showvariantlist = false;
            $scope.showAddVariant = false;
            $scope.GetProducts(productline);
        }

        $scope.ViewServices = function(serviceline)
        {
            $scope.isAddProductHidden = false;
            $scope.isProductSKUHidden = true;
            $scope.showvariantlist = false;
            $scope.showAddVariant = false;
            $scope.GetProducts(serviceline);
        }

        $scope.SubmitProductSKUEdit = function(formData)
        {
            if(formData)
            {
                if(!formData.price)
                {
                    toastr.error('Please enter a product price', 'Store');
                }
                else
                {


                        $http.post(PATHS.api_url + 'stores/product/productSKU/'+formData.id+'/update'
                            , {
                                data:
                                {
                                    productDiscount:formData.discount,
                                    productPrice:formData.price,
                                    productShipmentCharge:formData.shipping_charge,
                                    productSize:formData.size,
                                    productColor:formData.color,
                                    productWeight:formData.weight,
                                    productVolume:formData.volume,
                                    productImages:$scope.productImages
                                },
                                headers: {'Content-Type': 'application/json'}
                            }).
                            success(function (data, status, headers, config)
                            {
                                ngDialog.close();
                                $scope.showAddVariant = false;
                                $scope.productImages = [];
                                $scope.GetProductSKU($rootScope.currentSelectedProduct);
                                toastr.success(data.message, 'Store');
                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Store');
                            }).then(function()
                            {

                            });
                }
            }
            else
            {
                toastr.error('Please enter a product title', 'Store');
            }

        }

        $scope.DeleteProductImage = function (productImageId,index,images)
        {
            $http.get(PATHS.api_url + 'stores/product/productImages/'+productImageId+'/delete').
                success(function (data, status, headers, config)
                {
                    images.splice(index, 1);
                    toastr.success(data.message, 'Store');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Store');
                }).then(function()
                {
                    //$scope.GetProducts($rootScope.selectedProductLine.id);
                    $scope.GetProducts($rootScope.selectedProductLine.id);
                });
        }

        //stores/product/productImages/{productImageId}/delete
        //stores/product/productSKU/{productSKUId}/update


        var uploader = $scope.uploader = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload:true,
            alias: 'image'
        });

        // FILTERS

        uploader.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });


        uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function(fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function(addedFileItems)
        {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function(item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function(fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function(progress) {
            console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers)
        {
        	$scope.ImageSize = fileItem.file.size;
            $scope.productImages.push(response.imageName);
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
        	$scope.ImageSize = fileItem.file.size;
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function(fileItem, response, status, headers)
        {

        };
        uploader.onCompleteAll = function()
        {
        	if($scope.ImageSize > 2000000)
            {
                toastr.error("Please upload image of size less than 2 MB")
            }
            else
            {
                $scope.isImageUploadComplete = true;
            }
            //$scope.isImageUploadComplete = true;
        };


        //editing product line(popup template with data)
        $scope.EditProductLine = function(selectedProductLine)
        {
            $rootScope.editProductLine = selectedProductLine;
            
            $rootScope.EditProductLineTypes = [
                {
                    id: 0,
                    name: 'Product'
                },
                {
                    id: 1,
                    name: 'Services'
                }];

                if(selectedProductLine.type == "0")
                {

                    $rootScope.EditProductLineType = $scope.EditProductLineTypes[0];
                }
                else
                {
                    $rootScope.EditProductLineType = $scope.EditProductLineTypes[1];
                }
                ngDialog.open({ template: 'templateId' });
            
        }

        //editing product line in the popup template and submitting
        $scope.SubmitEditProductLine = function(EditPdtLineTitle,EditPdtLineDescription,EditPdtLineType)
        {
            
            $PdtLineId = $rootScope.editProductLine.id;
            
            if(!EditPdtLineTitle)
            {
                toastr.error('Please enter a title', 'Store');
            }
            else if(!EditPdtLineDescription)
            {
                toastr.error('Please enter description', 'Store');
            }
            else if(!EditPdtLineType)
            {
                toastr.error('Please select a product line type', 'Store');
            }
            else
            {

                $http.post(PATHS.api_url + 'stores/productline/'+$PdtLineId+'/update'
                    , {
                        data:
                        {
                            title:EditPdtLineTitle,
                            description:EditPdtLineDescription,
                            productLineType:EditPdtLineType.id
                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                    success(function (data, status, headers, config)
                    {
                        toastr.success(data.message, 'Store');
                        ngDialog.close();

                    }).error(function (data)
                    {
                        toastr.error(data.error.message, 'Store');
                    }).then(function()
                    {
                        $scope.GetProductLine();
                    });
            }
        }

        $scope.AddProductVariant = function (product)
        {
            $scope.showAddVariant = true;
            $scope.showvariantlist = false;
            $rootScope.currentProduct = product;
        }

        $scope.ShowVariants = function(productSKU)
        {
            $scope.showvariantlist = true;
            $rootScope.AllProductSKU = productSKU;    // update goes here
        }

        $scope.UpdateProduct = function(product)
        {
            $scope.showvariantlist = true;
            angular.forEach($rootScope.AllProductLines, function (value, key)
            {
                if($rootScope.currentProductLine.id == value.id)
                {
                    $rootScope.currentProductLine = value;
                }
            });

            $rootScope.currentProduct = product;
            ngDialog.open({ template: 'editProduct' });
        }

        $scope.UpdateProductSKU = function(productSKU)
        {
            $rootScope.currentProductSKU = productSKU;
            ngDialog.open({ template: 'editProductSKU' });
        }

        $scope.UpdateProductStock = function(productSKU)
        {
            $rootScope.currentProductSKU = productSKU;
            ngDialog.open({ template: 'editProductStock' });
        }


        $scope.SubmitProductStock = function(productSKU)
        {
            $http.post(PATHS.api_url + 'stores/product/productStock/'+productSKU.id+'/update'
                , {
                    data:
                    {
                        productStock:productSKU.product_stock.quantity
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Store');
                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Store');
                }).then(function()
                {
                    ngDialog.close();
                });
        }

        $scope.SubmitProductEdit = function(product)
        {
            $http.post(PATHS.api_url + 'stores/product/'+$rootScope.currentProduct.id+'/update'
                , {
                    data:
                    {
                        productTitle:product.title,
                        description:product.description,
                        productLineTypeId:$rootScope.selectedProductLine.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Store');
                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Store');
                }).then(function()
                {
                    $scope.GetProducts($rootScope.selectedProductLine.id);
                    ngDialog.close();
                });
        }


        $scope.$watch('AllProductSKU', function(newvalue,oldvalue)
        {
            $rootScope.AllProductSKU = newvalue;
        });

        $scope.Cancel = function ()
        {
            $scope.showAddVariant = false;
            $rootScope.currentProduct = null;
        }
        $scope.CancelShow = function ()
        {
            $scope.showvariantlist = false;
            $rootScope.AllProductSKU = null;
        }

        $scope.DeleteProductLine = function ($productLineId)
        {
            $http.get(PATHS.api_url + 'stores/productline/'+$productLineId+'/delete').
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Store');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Store');
                }).then(function()
                {
                    $scope.GetProductLine();
                });
        }

        $scope.DeleteProduct = function (productId)
        {
            $http.get(PATHS.api_url + 'stores/product/'+productId+'/delete').
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Store');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Store');
                }).then(function()
                {
                    $scope.GetProducts($rootScope.selectedProductLine)
                });
        }

        $scope.DeleteProductSKU = function (productSKUId)
        {
            $http.get(PATHS.api_url + 'stores/product/productSKU/'+productSKUId+'/delete').
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Store');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Store');
                }).then(function()
                {
                    $scope.GetProductSKU($rootScope.currentSelectedProduct);
                });
        }


        $scope.GetProductLine();
        $scope.GetCurrentStore();

        $scope.productLines = [
            {id: 1, product_line: 'Designer Bags'},
            {id: 2, product_line: 'Designer Shoes'}
        ];


        $scope.products = [
            {id: 1, title: 'Bag 1', price: 800, stock: 0},
            {id: 2, title: 'Bag 2', price: 750, stock: 10},
            {id: 3, title: 'Bag 1', price: 800, stock: 0},
            {id: 4, title: 'Bag 2', price: 750, stock: 10},
            {id: 5, title: 'Bag 1', price: 800, stock: 0},
            {id: 6, title: 'Bag 2', price: 750, stock: 10},
            {id: 7, title: 'Bag 1', price: 800, stock: 0},
            {id: 8, title: 'Bag 2', price: 750, stock: 10},
            {id: 9, title: 'Bag 1', price: 800, stock: 0},
            {id: 10, title: 'Bag 2', price: 750, stock: 10},
            {id: 11, title: 'Bag 1', price: 800, stock: 0},
            {id: 12, title: 'Bag 2', price: 750, stock: 10}
        ];

        $scope.productsTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: $scope.products.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.products.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })

        $scope.productCatalogueTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 5           // count per page
        }, {
            total: $scope.products.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.products.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })

        $scope.productLineTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 4           // count per page
        })



    });

