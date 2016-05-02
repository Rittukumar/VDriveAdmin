/**
 * Created by Viswanathan on 6/11/2015.
 */
evezownApp
    .controller('CreateStoreController', function ($scope, ngDialog, $location, $controller, $http, $cookieStore, PATHS, FileUploader, $rootScope, $routeParams) {

        //   $scope.owners = ['Owner 1'];
        $scope.owners = [];
        $scope.formData = [];
        $scope.owners.push({'title': '', 'name': 'Owner 1', 'id': ''});
        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentStore = null;
        $scope.billingName = null;
        $scope.storeTitle = null; 
        $scope.storeEmail  = null; 
        $scope.profileImage = "";
        $scope.collage1 = "";
        $scope.collage2 = "";
        $scope.collage3 = "";
        $scope.formData.storeContactEmail="";
        $scope.formData.StoreName = "";

        $scope.filePath = PATHS.api_url + 'image/show/';

        $scope.addStores = {};
        $scope.addCollage = {};
        $scope.linkPersonalProfileToStore = false;
        $scope.isProfileImageUploaded = false;
        $scope.isCollageImageUploaded = false;
        $scope.addCollage.LeftCollageImage = {};
        $scope.addCollage.RightCollageImage = {};
        $scope.addCollage.BottomCollageImage = {};
        $scope.addCollage.ProfileCollageImage = {};
        $scope.addStores.slideImage = {};
        $scope.addStores.slideImage1 = {};
        $scope.addStores.slideImage2 = {};
        $scope.addStores.slideImage3 = {};
        $scope.addCollage.LeftCollageImage.croppedImage = "";
        $scope.addCollage.RightCollageImage.croppedImage = "";
        $scope.addCollage.BottomCollageImage.croppedImage = "";
        $scope.addCollage.ProfileCollageImage.croppedImage = "";
        $scope.addStores.slideImage.croppedImage = "";
        $scope.addStores.slideImage1.croppedImage = "";
        $scope.addStores.slideImage2.croppedImage = "";
        $scope.addStores.slideImage3.croppedImage = "";


        $scope.contractFilename = "";
        $scope.priceList = "";


        $scope.subListing = [];
        $scope.subListing.push({'name': 'Product', 'id': '3'});
        $scope.subListing.push({'name': 'Services', 'id': '4'});
        $scope.subListing.push({'name': 'Product & Services', 'id': '5'});

        $scope.categoryId = '1';

        $scope.allStores = [];

        $scope.storeListing = [];

        $scope.storeSubscription = [];
        $scope.selectedSubscription = null;

        $scope.classifiedImages = [];

        //   $scope.selectedStoreListing = null;

        $scope.selectedSubscription = null;

        $scope.facebookLink = null;
        $scope.twitterLink = null;
        $scope.linkedinLink = null;
        $scope.websiteUrl = null;

        $scope.tags = [];
        $scope.loadTags = function (query) {
            return $http.get('/tags?query=' + query);
        };

        if ($routeParams.storeId) {
            $scope.currentStoreId = $routeParams.storeId;
        }
        else if ($routeParams.id) {
            $scope.currentStoreId = $routeParams.id;
        }
        else {
            $scope.currentStoreId = $cookieStore.get('storeId');
        }


        $scope.addMoreOwner = function () {
            var index = $scope.owners.length + 1;
            $scope.owners.push({'title': '', 'name': 'Owner ' + index, 'id': ''});
        };

        if ($cookieStore.get('storeId')) {
            $scope.createStoreNavLinks = [{
                Title: 'step1',
                LinkText: 'Step1'
            }, {
                Title: 'step2',
                LinkText: 'Step2'
            }, {
                Title: 'step3',
                LinkText: 'Step3'
            }, {
                Title: 'step4',
                LinkText: 'Step4'
            }, {
                Title: 'step5',
                LinkText: 'Step5'
            }, {
                Title: 'step6',
                LinkText: 'Step6'
            }];
        }
        else {
            $scope.createStoreNavLinks = [{
                Title: 'step1',
                LinkText: 'Step1'
            }, {
                Title: '#',
                LinkText: 'Step2'
            }, {
                Title: '#',
                LinkText: 'Step3'
            }, {
                Title: '#',
                LinkText: 'Step4'
            }, {
                Title: '#',
                LinkText: 'Step5'
            }, {
                Title: '#',
                LinkText: 'Step6'
            }];
        }


        $scope.SetStoreSubscription = function (sub) {
            $scope.selectedSubscription = sub;
        }

        $scope.SaveStoreStep1 = function (formData, owners) {
            var title = '';
            if (formData) {
                if (owners.length > 0) {
                    var title = owners[0]['title'];
                }
                if (!formData.title) {
                    toastr.error('Please enter a store title', 'Store');
                }
                else if (!formData.storeDescription) {
                    toastr.error('Please enter store description', 'Store');
                }
                else if (title == '') {
                    toastr.error('Please enter a store owner', 'Store');
                }
                else if (!formData.address) {
                    toastr.error('Please enter address', 'Store');
                }
                else {
                    $http.post(PATHS.api_url + 'users/store/' + $scope.loggedInUserId + '/add'
                        , {
                            data: {
                                user_id: $scope.loggedInUserId,
                                title: formData.title,
                                storeDescription: formData.storeDescription,
                                owners: owners,
                                address: formData.address,
                                isPhysicalStore: formData.isPhysicalStore,
                                licenseInfo: formData.licenseInfo,
                                storeAddress: formData.storeAddress,
                                cityStateCountry: formData.cityStateCountry,
                                pincode: formData.pincode,
                                storeId: $scope.currentStoreId
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                    success(function (data, status, headers, config) {
                        //   toastr.success(data.message, 'Store');
                        if ($scope.currentStoreId == undefined) {
                            $cookieStore.put('storeId', data.id);
                        }
                        $location.path('/store/create/step2');

                    }).error(function (data) {
                        toastr.error(data.error.message, 'Store');
                    }).then(function () {

                    });
                }
            }
            else {
                toastr.error('Please enter a store title', 'Store');
            }
        }

        $scope.EditStoreStep1 = function (formData, owners) {
            var title = '';
            if (formData) {
                if (owners.length > 0) {
                    var title = owners[0]['title'];
                }
                if (!formData.title) {
                    toastr.error('Please enter a store title', 'Store');
                }
                else if (!formData.storeDescription) {
                    toastr.error('Please enter store description', 'Store');
                }
                else if (title == '') {
                    toastr.error('Please enter a store owner', 'Store');
                }
                else if (!formData.address) {
                    toastr.error('Please enter address', 'Store');
                }
                else {
                    $http.post(PATHS.api_url + 'users/store/' + $scope.loggedInUserId + '/add'
                        , {
                            data: {
                                user_id: formData.OwnerID,
                                title: formData.title,
                                storeDescription: formData.storeDescription,
                                owners: owners,
                                address: formData.address,
                                isPhysicalStore: formData.isPhysicalStore,
                                licenseInfo: formData.licenseInfo,
                                storeAddress: formData.storeAddress,
                                cityStateCountry: formData.cityStateCountry,
                                pincode: formData.pincode,
                                storeId: $scope.currentStoreId
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                    success(function (data, status, headers, config) {
                        toastr.success(data.message, 'Store');
                        if ($scope.currentStoreId == undefined) {
                            $cookieStore.put('storeId', data.id);
                        }
                        //$location.path('/store/create/step2');

                    }).error(function (data) {
                        toastr.error(data.error.message, 'Store');
                    }).then(function () {

                    });
                }
            }
            else {
                toastr.error('Please enter a store title', 'Store');
            }
        }

        $scope.SaveStoreStep2 = function (formData) {
            if ($scope.currentStoreId == undefined) {
                toastr.error('Please complete step1', 'Store');
            }
            else {
            	var iscontract=0;
            	
            	if($scope.formData.contract){
            		iscontract = 1;
            	}

                if (!$scope.selectedSubscription) {
                    toastr.error('Please select store type', 'Store');
                }
                else if (!formData.billingName) {
                    toastr.error('Please enter billing name', 'Store');
                }
                else if (!formData.billingAddress) {
                    toastr.error('Please enter billing address', 'Store');
                }
                else if (!formData.billingContactNumber) {
                    toastr.error('Please enter contact number', 'Store');
                }else if (iscontract == 0) {
                    toastr.error('Please accept the contract agreement', 'Store');
                }
                else {
                    $http.post(PATHS.api_url + 'users/store/step2/' + $scope.loggedInUserId + '/add'
                        , {
                            data: {
                                StoreId: $scope.currentStoreId,
                                storeType: $scope.selectedSubscription.id,
                                panNumber: formData.panNumber,
                                tinNumber: formData.tinNumber,
                                vatNumber: formData.vatNumber,
                                serviceTaxId: formData.serviceTaxId,
                                tanNumber: formData.tanNumber,
                                evezownContract: $scope.contractFilename,
                                billingName: formData.billingName,
                                billingAddress: formData.billingAddress,
                                billingContactNumber: formData.billingContactNumber,
                                isContractAgreed: iscontract
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                    success(function (data, status, headers, config) {
                        //toastr.success(data.message, 'Store');
                        
                        if ($scope.billingName == undefined || $scope.billingName == null) {
                            $cookieStore.put('IsStep2', data.id);
                        }
                        
                        $location.path('/store/create/step3');

                    }).error(function (data) {
                        toastr.error(data.error.message, 'Store');
                    }).then(function () {

                    });
                }

            }

        }

        $scope.EditStoreStep2 = function (formData) {
            if ($scope.currentStoreId == undefined) {
                toastr.error('Please complete step1', 'Store');
            }
            else {

                if (!$scope.selectedSubscription) {
                    toastr.error('Please select store type', 'Store');
                }
                else if (!formData.billingName) {
                    toastr.error('Please enter billing name', 'Store');
                }
                else if (!formData.billingAddress) {
                    toastr.error('Please enter billing address', 'Store');
                }
                else if (!formData.billingContactNumber) {
                    toastr.error('Please enter contact number', 'Store');
                }
                else {
                    $http.post(PATHS.api_url + 'users/store/step2/' + $scope.loggedInUserId + '/add'
                        , {
                            data: {
                                StoreId: $scope.currentStoreId,
                                storeType: $scope.selectedSubscription.id,
                                panNumber: formData.panNumber,
                                tinNumber: formData.tinNumber,
                                vatNumber: formData.vatNumber,
                                serviceTaxId: formData.serviceTaxId,
                                tanNumber: formData.tanNumber,
                                evezownContract: $scope.formData.evezownContract,
                                billingName: formData.billingName,
                                billingAddress: formData.billingAddress,
                                billingContactNumber: formData.billingContactNumber,
                                isContractAgreed:1
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                    success(function (data, status, headers, config) {
                        toastr.success(data.message, 'Store');
                        // $location.path('/store/create/step3');

                    }).error(function (data) {
                        toastr.error(data.error.message, 'Store');
                    }).then(function () {

                    });
                }

            }

        }

        $scope.SaveStoreStep3 = function (formData) {
            if ($scope.currentStoreId == undefined) {
                toastr.error('Please complete step1', 'Store');
            }
            else if($cookieStore.get('IsStep2')== null){
               toastr.error('Please complete step2 and save', 'Store');
               $location.path('/store/create/step2');
            }
            else {

                $scope.collage1 = "";
                $scope.collage2 = "";
                $scope.collage3 = "";
                $scope.profileImage = "";

                if ($scope.addCollage.LeftCollageImage) {
                    $scope.collage1 = $scope.addCollage.LeftCollageImage.croppedImage;
                }
                
                if ($scope.addCollage.RightCollageImage) {
                    $scope.collage2 = $scope.addCollage.RightCollageImage.croppedImage;
                }
                
                if ($scope.addCollage.BottomCollageImage) {
                    $scope.collage3 = $scope.addCollage.BottomCollageImage.croppedImage;
                }
                
                if ($scope.addCollage.ProfileCollageImage) {
                    $scope.profileImage = $scope.addCollage.ProfileCollageImage.croppedImage;
                }
                

                if (!formData.storeTitle) {
                    toastr.error('Please enter store title', 'Store');
                }
                else if (!$scope.addCollage.LeftCollageImage.croppedImage) {
                    toastr.error('Please add Left Collage image', 'Store');
                }
                else if (!$scope.addCollage.RightCollageImage.croppedImage) {
                    toastr.error('Please add Right Collage image', 'Store');
                }
                else if (!$scope.addCollage.BottomCollageImage.croppedImage) {
                    toastr.error('Please add Bottom Collage image', 'Store');
                }
                else if (!$scope.addCollage.ProfileCollageImage.croppedImage) {
                    toastr.error('Please add Profile Collage image', 'Store');
                }
                else if (!$rootScope.selectedStoreListing) {
                    toastr.error('Please select listing type', 'Store');
                }
                else if (!$scope.selectedOption) {
                    toastr.error('Please select one category', 'Store');
                }
                else if (!$scope.selectedSubCategory) {
                    toastr.error('Please select one sub category', 'Store');
                }
                else {
                    $http.post(PATHS.api_url + 'users/store/step3/' + $scope.loggedInUserId + '/add'
                        , {
                            data: {
                                StoreId: $scope.currentStoreId,
                                storeTitle: formData.storeTitle,
                                storeAboutUs: formData.storeAboutUs,
                                storeOwnerInfo: formData.storeOwnerInfo,
                                storeTargetAudience: formData.storeTargetAudience,
                                storeOfferings: formData.storeOfferings,
                                storeMotto: formData.storeMotto,
                                storeVision: formData.storeVision,
                                storePurpose: formData.storePurpose,
                                storeCity: formData.storeCity,
                                storeCategory: $scope.selectedOption.id,
                                listingTypeId: $rootScope.selectedStoreListing.id,
                                storeSubCategory: $scope.selectedSubCategory.id,
                                storeTags: $scope.tags,
                                collage1: $scope.collage1,
                                collage2: $scope.collage2,
                                collage3: $scope.collage3,
                                profileImage: $scope.profileImage
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                    success(function (data, status, headers, config) {
                        //  toastr.success(data.message, 'Store');
                        if ($scope.storeTitle == undefined || $scope.storeTitle == null) {
                            $cookieStore.put('IsStep3', data.id);
                        }

                        $scope.collage1 = "";
                        $scope.collage2 = "";
                        $scope.collage3 = "";
                        $location.path('/store/create/step4');

                    }).error(function (data) {
                        toastr.error(data.error.message, 'Store');
                    }).then(function () {

                    });
                }
            }

        }

        $scope.EditStoreStep3 = function (formData) {
            if ($scope.currentStoreId == undefined) {
                toastr.error('Please complete step1', 'Store');
            }
            else {

                if (!formData.storeTitle) {
                    toastr.error('Please enter store title', 'Store');
                }
                else {

                    $scope.collage1 = "";
                    $scope.collage2 = "";
                    $scope.collage3 = "";
                    $scope.profileImage = "";

                    if ($scope.addCollage.LeftCollageImage) {
                        $scope.collage1 = $scope.addCollage.LeftCollageImage.croppedImage;
                    }
                    
                    if ($scope.addCollage.RightCollageImage) {
                        $scope.collage2 = $scope.addCollage.RightCollageImage.croppedImage;
                    }
                    
                    if ($scope.addCollage.BottomCollageImage) {
                        $scope.collage3 = $scope.addCollage.BottomCollageImage.croppedImage;
                    }
                    
                    if ($scope.addCollage.ProfileCollageImage) {
                        $scope.profileImage = $scope.addCollage.ProfileCollageImage.croppedImage;
                    }
                    $http.post(PATHS.api_url + 'users/store/step3/' + $scope.loggedInUserId + '/add'
                        , {
                            data: {
                                StoreId: $scope.currentStoreId,
                                storeTitle: formData.storeTitle,
                                storeAboutUs: formData.storeAboutUs,
                                storeOwnerInfo: formData.storeOwnerInfo,
                                storeTargetAudience: formData.storeTargetAudience,
                                storeOfferings: formData.storeOfferings,
                                storeMotto: formData.storeMotto,
                                storeVision: formData.storeVision,
                                storePurpose: formData.storePurpose,
                                storeCity: formData.storeCity,
                                storeCategory: $scope.selectedOption.id,
                                listingTypeId: $rootScope.selectedStoreListing.id,
                                storeSubCategory: $scope.selectedSubCategory.id,
                                storeTags: $scope.tags,
                                collage1: $scope.collage1,
                                collage2: $scope.collage2,
                                collage3: $scope.collage3,
                                profileImage: $scope.profileImage
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                    success(function (data, status, headers, config) {
                        $scope.collage1 = "";
                        $scope.collage2 = "";
                        $scope.collage3 = "";
                        toastr.success(data.message, 'Store');
                        //$location.path('/store/create/step4');

                    }).error(function (data) {
                        toastr.error(data.error.message, 'Store');
                    }).then(function () {

                    });
                }
            }

        }

        //popup for downloading contract
        $scope.ContractDownload = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'ContractDownload',
                    scope: $scope,
                    className: 'ngdialog-theme-plain'
                });

        }

        $scope.SetCategoryType = function (listing) {
            $scope.categoryId = listing.id;
            $scope.GetCategories();
        }

        $scope.SaveStoreStep4 = function (formData) {
             if($cookieStore.get('IsStep2')== null){
               toastr.error('Please complete step2 and save', 'Store');
               $location.path('/store/create/step2');
            }
            else if($cookieStore.get('IsStep3')== null){
               toastr.error('Please complete step3 and save', 'Store');
               $location.path('/store/create/step3');
            }
            else if (!formData.storeEmail) {
                toastr.error('Please enter your email id', 'Store');
            }
            else {
                $http.post(PATHS.api_url + 'users/store/step4/' + $scope.loggedInUserId + '/add'
                    , {
                        data: {
                            StoreId: $scope.currentStoreId,
                            storeEmail: formData.storeEmail,
                            storePhone1: formData.storePhone1,
                            storePhone2: formData.storePhone2,
                            storePhone3: formData.storePhone3,
                            termsconditions: formData.termsconditions,
                            policies: formData.policies,
                            salesReturnPolicy: formData.salesReturnPolicy,
                            link1: formData.link1,
                            link2: formData.link2,
                            link3: formData.link3
                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                success(function (data, status, headers, config) {
                    //toastr.success(data.message, 'Store');
                    if ($scope.storeEmail == undefined || $scope.storeEmail == null) {
                            $cookieStore.put('IsStep4', data.id);
                        }
                    $location.path('/store/create/step5');

                }).error(function (data) {
                    toastr.error(data.error.message, 'Store');
                }).then(function () {

                });
            }
        }

        $scope.EditStoreStep4 = function (formData) {
            if (!formData.storeEmail) {
                toastr.error('Please enter your email id', 'Store');
            }
            else {
                $http.post(PATHS.api_url + 'users/store/step4/' + $scope.loggedInUserId + '/add'
                    , {
                        data: {
                            StoreId: $scope.currentStoreId,
                            storeEmail: formData.storeEmail,
                            storePhone1: formData.storePhone1,
                            storePhone2: formData.storePhone2,
                            storePhone3: formData.storePhone3,
                            termsconditions: formData.termsconditions,
                            policies: formData.policies,
                            salesReturnPolicy: formData.salesReturnPolicy,
                            link1: formData.link1,
                            link2: formData.link2,
                            link3: formData.link3
                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                success(function (data, status, headers, config) {
                    toastr.success(data.message, 'Store');
                    //$location.path('/store/create/step5');

                }).error(function (data) {
                    toastr.error(data.error.message, 'Store');
                }).then(function () {

                });
            }
        }

        $scope.EditStoreFrontFooter = function (formData) {
            $http.post(PATHS.api_url + 'users/store/updatestorefooter/' + $scope.loggedInUserId + '/update'
                , {
                    data: {
                        StoreId: $scope.currentStoreId,
                        termsconditions: formData.termsconditions,
                        policies: formData.policies,
                        salesReturnPolicy: formData.salesReturnPolicy
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                toastr.success(data.message, 'Store');
                //$location.path('/store/create/step5');

            }).error(function (data) {
                toastr.error(data.error.message, 'Store');
            }).then(function () {

            });
        }

        $scope.SaveStoreStep5 = function (formData) {

             if($cookieStore.get('IsStep2')== null){
               toastr.error('Please complete step2 and save', 'Store');
               $location.path('/store/create/step2');
            }

            else if($cookieStore.get('IsStep3')== null){
               toastr.error('Please complete step3 and save', 'Store');
               $location.path('/store/create/step3');
            }
             
            else if($cookieStore.get('IsStep4')== null){
               toastr.error('Please complete step4 and save', 'Store');
               $location.path('/store/create/step4');
            }

           else{ $scope.classifiedImage1 = "";
            $scope.classifiedImage2 = "";
            $scope.classifiedImage3 = "";
            $scope.classifiedImage4 = "";

            if ($scope.addStores.slideImage) {
                $scope.classifiedImage1 = $scope.addStores.slideImage.croppedImage;
            }
            else {
                $scope.classifiedImage1 = "";
            }

            if ($scope.addStores.slideImage1) {
                $scope.classifiedImage2 = $scope.addStores.slideImage1.croppedImage;
            }
            else {
                $scope.classifiedImage2 = "";
            }

            if ($scope.addStores.slideImage2) {
                $scope.classifiedImage3 = $scope.addStores.slideImage2.croppedImage;
            }
            else {
                $scope.classifiedImage3 = "";
            }

            if ($scope.addStores.slideImage3) {
                $scope.classifiedImage4 = $scope.addStores.slideImage3.croppedImage;
            }
            else {
                $scope.classifiedImage4 = "";
            }

            $http.post(PATHS.api_url + 'users/store/step5/' + $scope.loggedInUserId + '/add'
                , {
                    data: {
                        StoreId: $scope.currentStoreId,
                        classifiedTagline: formData.classifiedTagline,
                        classifiedPrice: formData.classifiedPrice,
                        classifiedDescription: formData.classifiedDescription,
                        classifiedImages: $scope.classifiedImages,
                        classifiedImage1: $scope.classifiedImage1,
                        classifiedImage2: $scope.classifiedImage2,
                        classifiedImage3: $scope.classifiedImage3,
                        classifiedImage4: $scope.classifiedImage4
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                //toastr.success(data.message, 'Store');
                $scope.classifiedImages = [];
                $location.path('/store/create/step6');

            }).error(function (data) {
                toastr.error(data.error.message, 'Store');
            }).then(function () {

            });
            }
        }

        $scope.EditStoreStep5 = function (formData) {
            $scope.classifiedImage1 = "";
            $scope.classifiedImage2 = "";
            $scope.classifiedImage3 = "";
            $scope.classifiedImage4 = "";

            if ($scope.addStores.slideImage) {
                $scope.classifiedImage1 = $scope.addStores.slideImage.croppedImage;
            }
            else {
                $scope.classifiedImage1 = "";
            }

            if ($scope.addStores.slideImage1) {
                $scope.classifiedImage2 = $scope.addStores.slideImage1.croppedImage;
            }
            else {
                $scope.classifiedImage2 = "";
            }

            if ($scope.addStores.slideImage2) {
                $scope.classifiedImage3 = $scope.addStores.slideImage2.croppedImage;
            }
            else {
                $scope.classifiedImage3 = "";
            }

            if ($scope.addStores.slideImage3) {
                $scope.classifiedImage4 = $scope.addStores.slideImage3.croppedImage;
            }
            else {
                $scope.classifiedImage4 = "";
            }

            $http.post(PATHS.api_url + 'users/store/step5/' + $scope.loggedInUserId + '/add'
                , {
                    data: {
                        StoreId: $scope.currentStoreId,
                        classifiedTagline: formData.classifiedTagline,
                        classifiedPrice: formData.classifiedPrice,
                        classifiedDescription: formData.classifiedDescription,
                        classifiedImages: $scope.classifiedImages,
                        classifiedImage1: $scope.classifiedImage1,
                        classifiedImage2: $scope.classifiedImage2,
                        classifiedImage3: $scope.classifiedImage3,
                        classifiedImage4: $scope.classifiedImage4
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                $scope.classifiedImages = [];
                toastr.success(data.message, 'Store');
                //$location.path('/store/create/step6');

            }).error(function (data) {
                toastr.error(data.error.message, 'Store');
            }).then(function () {

            });
        }

        $scope.ChangeSelectedValue = function (sub) {
            $scope.selectedSubscription = sub;
        }

        $scope.SaveStoreStep6 = function (formData) {
            
            if($cookieStore.get('IsStep2')== null){
               toastr.error('Please complete step2 and save', 'Store');
               $location.path('/store/create/step2');
            }
            
            else if($cookieStore.get('IsStep3')== null){
               toastr.error('Please complete step3 and save', 'Store');
               $location.path('/store/create/step3');
            }
             
            else if($cookieStore.get('IsStep4')== null){
               toastr.error('Please complete step4 and save', 'Store');
               $location.path('/store/create/step4');
            }
 
            else if (!formData.free) {
                toastr.error('Please Choose Stream -it subscription', 'Store');
            }
            else {
                $http.post(PATHS.api_url + 'users/store/step6/' + $scope.loggedInUserId + '/add'
                    , {
                        data: {
                            StoreId: $scope.currentStoreId,
                            linkPersonalProfileToStore: $scope.linkPersonalProfileToStore,
                            reccoSub: $scope.selectedSubscription.id,
                            facebookLink: $scope.facebookLink,
                            twitterLink: $scope.twitterLink,
                            linkedinLink: $scope.linkedinLink,
                            storePriceList: $scope.priceList,
                            websiteUrl: $scope.websiteUrl
                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                success(function (data, status, headers, config) {
                    //
                    toastr.success(data.message, 'Store');
                    $location.path('/store/create/success');
                }).error(function (data) {
                    toastr.error(data.error.message, 'Store');
                }).then(function () {
                    $rootScope.currentStrId = $scope.currentStoreId;
                    $cookieStore.remove('storeId');
                });
            }

        }

        $scope.EditStoreStep6 = function (formData) {
            $http.post(PATHS.api_url + 'users/store/step6/' + $scope.loggedInUserId + '/add'
                , {
                    data: {
                        StoreId: $scope.currentStoreId,
                        linkPersonalProfileToStore: $scope.linkPersonalProfileToStore,
                        reccoSub: $scope.selectedSubscription.id,
                        facebookLink: $scope.facebookLink,
                        twitterLink: $scope.twitterLink,
                        linkedinLink: $scope.linkedinLink,
                        websiteUrl: $scope.websiteUrl
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
            success(function (data, status, headers, config) {
                toastr.success(data.message, 'Store');
                // $location.path('/store/create/success');
            }).error(function (data) {
                toastr.error(data.error.message, 'Store');
            }).then(function () {
                $cookieStore.remove('storeId');
            });
        }

        $scope.PersonalProfileChecked = function (value) {
            $scope.linkPersonalProfileToStore = value;
        }


        var uploader = $scope.uploader = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
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


        uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.profileImage = response.imageName;
            $scope.isProfileImageUploaded = true;
        };
        uploader.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader.onCompleteAll = function () {

        };


        var uploader5 = $scope.uploader5 = new FileUploader({
            url: PATHS.api_url + 'file/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'files'
        });

        //// FILTERS
        //
        uploader5.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.name.slice(item.name.lastIndexOf('.') + 1) + '|';
                return '|doc|pdf|docx|'.indexOf(type) !== -1;
            }
        });


        uploader5.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
            toastr.error("Wrong file format");
        };
        uploader5.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader5.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader5.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader5.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader5.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader5.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.contractFilename = response.imageName;
            $http.post(PATHS.api_url + 'contract/upload'
                    , {
                        data: {
                            file_name: $scope.contractFilename,
                            storeID: $scope.currentStoreId,
                            storeEmail: $scope.formData.storeContactEmail,
                            storeName: $scope.formData.StoreName
                        },
                        headers: {'Content-Type': 'application/json'}
                    }).
                    success(function (data, status, headers, config)
                    { 
                    	toastr.success(data.message, 'success');
                    	$scope.GetStep1Data();
                    }).error(function (data)
                    {                      
                        toastr.error(data.error.message, 'error');
                    });
        };
        uploader5.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader5.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader5.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader5.onCompleteAll = function () {

        };


        var uploader4 = $scope.uploader4 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });

        // FILTERS

        uploader4.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });


        uploader4.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader4.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader4.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader4.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader4.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader4.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.classifiedImages.push(response.imageName);
        };
        uploader4.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader4.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader4.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader.onCompleteAll = function () {

        };

        var uploader1 = $scope.uploader1 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });

        // FILTERS

        uploader1.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });


        uploader1.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader1.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader1.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader1.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader1.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader1.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader1.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.collage1 = response.imageName;
        };
        uploader1.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader1.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader1.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader1.onCompleteAll = function () {
            $scope.isCollageImageUploaded = true;
        };

        var uploader2 = $scope.uploader2 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });

        // FILTERS

        uploader2.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });


        uploader2.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader2.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader2.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader2.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader2.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader2.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader2.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.collage2 = response.imageName;
        };
        uploader2.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader2.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader2.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader2.onCompleteAll = function () {
            $scope.isCollageImageUploaded = true;
        };

        var uploader3 = $scope.uploader3 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });

        // FILTERS

        uploader3.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });


        uploader3.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader3.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader3.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader3.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader3.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader3.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader3.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.collage3 = response.imageName;
        };
        uploader3.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader3.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader3.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader3.onCompleteAll = function () {
            $scope.isCollageImageUploaded = true;
        };


        var uploader6 = $scope.uploader6 = new FileUploader({
            url: PATHS.api_url + 'file/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'files'
        });

        // FILTERS

        //uploader6.filters.push({
        //    name: 'imageFilter',
        //    fn: function (item /*{File|FileLikeObject}*/, options) {
        //        var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
        //        return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        //    }
        //});


        uploader6.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
            console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader6.onAfterAddingFile = function (fileItem) {
            console.info('onAfterAddingFile', fileItem);
        };
        uploader6.onAfterAddingAll = function (addedFileItems) {
            $scope.counter = addedFileItems.length;
            console.info('onAfterAddingAll', addedFileItems);
        };
        uploader6.onBeforeUploadItem = function (item) {
            console.info('onBeforeUploadItem', item);
        };
        uploader6.onProgressItem = function (fileItem, progress) {
            console.info('onProgressItem', fileItem, progress);
        };
        uploader6.onProgressAll = function (progress) {
            console.info('onProgressAll', progress);
        };
        uploader6.onSuccessItem = function (fileItem, response, status, headers) {
            $scope.priceList = response.imageName;
        };
        uploader6.onErrorItem = function (fileItem, response, status, headers) {
            console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader6.onCancelItem = function (fileItem, response, status, headers) {
            console.info('onCancelItem', fileItem, response, status, headers);
        };
        uploader6.onCompleteItem = function (fileItem, response, status, headers) {

        };
        uploader6.onCompleteAll = function () {
            $scope.isCollageImageUploaded = true;
        };

        $scope.createStoreNavClass = function (page) {

            var currentRoute = $location.path().substring(1) || 'home';

            return page === currentRoute ? 'active' : '';
        };

        $scope.GetStoreListing = function () {
            $http.get(PATHS.api_url + 'users/store/listing/get').
            success(function (data, status, headers, config) {
                $scope.storeListing = data;
            }).error(function (data) {
                console.log(data);
            }).then(function (data) {
                $scope.GetCategories();
                $scope.GetStep1Data();
            });
        }

        /* Collage image */
        $scope.SelectLeftCollage = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'LeftCollage',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropLeftCollageCtrl', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addCollage.LeftCollageImage = {};
                    $scope.addCollage.LeftCollageImage.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        $scope.SelectRightCollage = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'RightCollage',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropRightCollageCtrl', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addCollage.RightCollageImage = {};
                    $scope.addCollage.RightCollageImage.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        $scope.SelectBottomCollage = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'BottomCollage',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropBottomCollageCtrl', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addCollage.BottomCollageImage = {};
                    $scope.addCollage.BottomCollageImage.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        $scope.SelectProfileCollage = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'ProfileCollage',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropProfileCollageCtrl', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addCollage.ProfileCollageImage = {};
                    $scope.addCollage.ProfileCollageImage.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        /* Slide image */

        $scope.CropSlideImage = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'cropSlideImageDialogId',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropSlideImageCtrl', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addStores.slideImage = {};
                    $scope.addStores.slideImage.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        $scope.CropSlideImage1 = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'cropSlideImageDialogId1',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropSlideImageCtrl1', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addStores.slideImage1 = {};
                    $scope.addStores.slideImage1.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        $scope.CropSlideImage2 = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'cropSlideImageDialogId2',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropSlideImageCtrl2', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addStores.slideImage2 = {};
                    $scope.addStores.slideImage2.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }

        $scope.CropSlideImage3 = function () {
            var cropTitleImageDialog = ngDialog.open(
                {
                    template: 'cropSlideImageDialogId3',
                    scope: $scope,
                    className: 'ngdialog-theme-plain',
                    controller: $controller('cropSlideImageCtrl3', {
                        $scope: $scope
                    })
                });

            cropTitleImageDialog.closePromise.then(function (data) {
                console.log('Crop Slide Image Response: ' + data);

                if (data.value.status) {
                    $scope.addStores.slideImage3 = {};
                    $scope.addStores.slideImage3.croppedImage = $scope.filePath + data.value.imageName;
                }

            });
        }


        $scope.GetCurrentStoreListing = function () {
            var selectedList = null;
            angular.forEach($scope.storeListing, function (value, key) {
                if (value.id == $scope.currentStore[0]['store_front_info']['listing_type_id']) {
                    selectedList = value;
                }
            });

            $rootScope.selectedStoreListing = selectedList;
        }

        $scope.GetCurrentCategory = function () {
            var selectedCat = null;
            angular.forEach($scope.categories, function (value, key) {
                if (value.id == $scope.currentStore[0]['store_category_id']) {
                    selectedCat = value;
                }
            });

            $scope.selectedOption = selectedCat;

            $scope.GetSubCategories();
        }

        $scope.GetCurrentSubCategory = function () {
            var selectedSubCat = null;
            angular.forEach($scope.subcategories, function (value, key) {
                if (value.id == $scope.currentStore[0]['store_subcategory_id']) {
                    selectedSubCat = value;
                }
            });

            $scope.selectedSubCategory = selectedSubCat;
        }

        $scope.GetCurrentTags = function () {
            $scope.tags = [];
            angular.forEach($scope.currentStore[0]['tags'], function (value, key) {
                var newTag = {text: value.name};
                if ($scope.tags.length < 7) {
                    $scope.tags.push(newTag);
                }

            });

        }

        $scope.$watch('tags', function (newvalue, oldvalue) {
            $scope.tags = newvalue;
        });

        $scope.$watch('selectedStoreListing', function (newvalue, oldvalue) {
            $rootScope.selectedStoreListing = newvalue;
        });

        $scope.$watch('selectedOption', function (newvalue, oldvalue) {
            $scope.selectedOption = newvalue;
        });

        $scope.GetStoreSubscription = function () {
            $http.get(PATHS.api_url + 'users/store/subscription/get').
            success(function (data, status, headers, config) {
                $scope.storeSubscription = data;

            }).error(function (data) {
                console.log(data);
            });
        }

        $scope.GetSelectedStoreSubscription = function () {
            var selectedList = null;
            angular.forEach($scope.storeSubscription, function (value, key) {
                if (value.id == $scope.currentStore[0]['store_subscription_id']) {
                    selectedList = value;
                }
            });
            $scope.selectedSubscription = selectedList;
        }

        //Loading subcategories based on categoryId
        $scope.GetSubCategories = function () {

            $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedOption.id).
            success(function (data) {
                $scope.subcategories = data.data;
            }).then(function () {
                $scope.GetCurrentSubCategory();
            });
        }

        $scope.GetCategories = function () {
            $http.get(PATHS.api_url + 'categories/3').
            success(function (data) {
                $scope.categories = data.data;
            }).then(function () {

            });
        }

        $scope.GetAllStores = function () {
            $http.get(PATHS.api_url + 'users/store/get').
            success(function (data) {
                $scope.allStores = data.data;
            });
        }


        $scope.GetStoreBySubCategory = function (subCatId) {
            $http.get(PATHS.api_url + 'users/store/' + subCatId + '/get').
            success(function (data) {
                $scope.allStores = data.data;
            });
        }

        $scope.GetStep1Data = function () {
            if ($scope.currentStoreId != undefined) {
                //stores/{store_id}/get
                $http.get(PATHS.api_url + 'stores/' + $scope.currentStoreId + '/get').
                success(function (data) {
                    $scope.currentStore = data;
                    //Get store subscription offers if any
                    $scope.storeStatus = $scope.currentStore[0].store_status.status_id;
                    $scope.Subscription_offer = $scope.currentStore[0].subscription_offer;
                    $scope.Subscription_type = $scope.currentStore[0].store_subscription_id;
                    

                    if ($scope.currentStore.length > 0) {

                        if (($location.path() == '/store/create/step1') || ($location.path() == '/store/' + $scope.currentStoreId + '/manage/store_info') || ($location.path() == '/admin/store/' + $scope.currentStoreId + '/manage/admin_store_info')) {
                            $scope.formData.title = $scope.currentStore[0]['title'];
                            if ($scope.currentStore[0]['own_a_physical_store'] == '1') {
                                $scope.formData.isPhysicalStore = true;
                            }
                            else {
                                $scope.formData.isPhysicalStore = false;
                            }
                            $scope.formData.address = $scope.currentStore[0]['street_address'];
                            $scope.formData.licenseInfo = $scope.currentStore[0]['license_info'];
                            $scope.formData.OwnerID = $scope.currentStore[0]['owner_id'];
                            $scope.formData.storeAddress = $scope.currentStore[0]['web_address'];
                            $scope.formData.storeDescription = $scope.currentStore[0]['description'];
                            $scope.formData.cityStateCountry = $scope.currentStore[0]['city'] + ' ' + $scope.currentStore[0]['state'] + ' ' + $scope.currentStore[0]['country'];
                            $scope.formData.pincode = $scope.currentStore[0]['zip'];
                            var counter = 1;
                            if ($scope.currentStore[0]['owner'].length > 0) {

                                $scope.owners = [];
                            }
                            angular.forEach($scope.currentStore[0]['owner'], function (value, key) {
                                $scope.owners.push({
                                    'title': value.owner_name,
                                    'name': 'Owner ' + counter,
                                    'id': value.id
                                });
                                counter++;
                            });
                        }
                        else if (($location.path() == '/store/create/step2') || ($location.path() == '/store/' + $scope.currentStoreId + '/manage/store_selection') || ($location.path() == '/admin/store/' + $scope.currentStoreId + '/manage/admin_store_selection')) {
                            $scope.formData.panNumber = $scope.currentStore[0]['business_info']['pan_number'];
                            $scope.formData.tinNumber = $scope.currentStore[0]['business_info']['tin_number'];
                            $scope.formData.vatNumber = $scope.currentStore[0]['business_info']['vat_number'];
                            $scope.formData.tanNumber = $scope.currentStore[0]['business_info']['tan_number'];
                            $scope.formData.serviceTaxId = $scope.currentStore[0]['business_info']['service_tax_id'];
                            $scope.formData.storeContractAggreement = $scope.currentStore[0]['business_info']['contract_aggreement'];
                            $scope.formData.billingName = $scope.currentStore[0]['business_info']['billing_info_name'];
                            $scope.formData.billingAddress = $scope.currentStore[0]['business_info']['billing_info_address'];
                            $scope.formData.billingContactNumber = $scope.currentStore[0]['business_info']['billing_info_contact_number'];
                            $scope.formData.storeContactEmail = $scope.currentStore[0]['store_front_info']['store_contact_email'];
                            $scope.formData.StoreName = $scope.currentStore[0]['title'];
                            $scope.GetSelectedStoreSubscription();
                        }
                        else if (($location.path() == '/store/create/step3') || ($location.path() == '/store/' + $scope.currentStoreId + '/manage/store_front') || ($location.path() == '/admin/store/' + $scope.currentStoreId + '/manage/admin_store_front')) {
                            $scope.formData.storeTitle = $scope.currentStore[0]['store_front_info']['store_caption'];
                            $scope.formData.storeAboutUs = $scope.currentStore[0]['store_front_info']['store_about_us'];
                            $scope.formData.storeTargetAudience = $scope.currentStore[0]['store_front_info']['target_audience'];
                            $scope.formData.storeOfferings = $scope.currentStore[0]['store_front_info']['offerings'];
                            $scope.formData.storeMotto = $scope.currentStore[0]['store_front_info']['motto'];
                            $scope.formData.storeVision = $scope.currentStore[0]['store_front_info']['vision'];
                            $scope.formData.storePurpose = $scope.currentStore[0]['store_front_info']['purpose'];
                            $scope.formData.storeCity = $scope.currentStore[0]['store_front_info']['store_city'];
                            $scope.GetCurrentStoreListing();
                            $scope.GetCurrentCategory();
                            $scope.GetCurrentTags();
                            if($scope.currentStore[0]['collage_image1']['large_image_url'])
                            {
                                $scope.addCollage.LeftCollageImage.croppedImage = $scope.currentStore[0]['collage_image1']['large_image_url'];
                            }
                            else
                            {
                                $scope.addCollage.LeftCollageImage.croppedImage = null;
                            }
                            if($scope.currentStore[0]['collage_image2']['large_image_url'])
                            {
                                $scope.addCollage.RightCollageImage.croppedImage = $scope.currentStore[0]['collage_image2']['large_image_url'];
                            }
                            else
                            {
                                $scope.addCollage.RightCollageImage.croppedImage = null;
                            }
                            if($scope.currentStore[0]['collage_image3']['large_image_url'])
                            {
                                $scope.addCollage.BottomCollageImage.croppedImage = $scope.currentStore[0]['collage_image3']['large_image_url'];
                            }
                            else
                            {
                                $scope.addCollage.BottomCollageImage.croppedImage = null;
                            }
                            if($scope.currentStore[0]['profile_images']['large_image_url'])
                            {
                                $scope.addCollage.ProfileCollageImage.croppedImage = $scope.currentStore[0]['profile_images']['large_image_url'];
                            }
                            else
                            {
                                $scope.addCollage.ProfileCollageImage.croppedImage = null;
                            }
                        }
                        else if (($location.path() == '/store/create/step4') || ($location.path() == '/store/' + $scope.currentStoreId + '/manage/store_crm') || ($location.path() == '/store/' + $scope.currentStoreId + '/manage/store_front_footer') || ($location.path() == '/admin/store/' + $scope.currentStoreId + '/manage/admin_store_front_footer')) {
                            $scope.formData.storeEmail = $scope.currentStore[0]['store_front_info']['store_contact_email'];
                            $scope.formData.storePhone1 = $scope.currentStore[0]['store_front_info']['store_contact_phone1'];
                            $scope.formData.storePhone2 = $scope.currentStore[0]['store_front_info']['store_contact_phone2'];
                            $scope.formData.storePhone3 = $scope.currentStore[0]['store_front_info']['store_contact_phone3'];
                            $scope.formData.termsconditions = $scope.currentStore[0]['store_front_info']['store_terms_conditions'];
                            $scope.formData.policies = $scope.currentStore[0]['store_front_info']['store_policies'];
                            $scope.formData.salesReturnPolicy = $scope.currentStore[0]['store_front_info']['store_sales_exchange_policy'];
                            $scope.formData.link1 = $scope.currentStore[0]['store_front_info']['store_mandatory_disclosure_link1'];
                            $scope.formData.link2 = $scope.currentStore[0]['store_front_info']['store_mandatory_disclosure_link2'];
                            $scope.formData.link3 = $scope.currentStore[0]['store_front_info']['store_mandatory_disclosure_link3'];
                        }
                        else if (($location.path() == '/store/create/step5') || ($location.path() == '/store/' + $scope.currentStoreId + '/manage/promotion') || ($location.path() == '/admin/store/' + $scope.currentStoreId + '/manage/admin_store_promotion')) {
                            $scope.formData.classifiedPrice = $scope.currentStore[0]['store_front_promotion']['promotion_price'];
                            $scope.formData.classifiedTagline = $scope.currentStore[0]['store_front_promotion']['promotion_tagline'];
                            $scope.formData.classifiedDescription = $scope.currentStore[0]['store_front_promotion']['promotion_description'];
                            if($scope.currentStore[0]['store_front_promotion']['image']['image1'])
                            {
                                $scope.addStores.slideImage.croppedImage = $scope.currentStore[0]['store_front_promotion']['image']['image1']['large_image_url'];
                            }
                            else
                            {
                                $scope.addStores.slideImage.croppedImage = null;
                            }

                            if($scope.currentStore[0]['store_front_promotion']['image']['image2'])
                            {
                                $scope.addStores.slideImage1.croppedImage = $scope.currentStore[0]['store_front_promotion']['image']['image2']['large_image_url'];
                            }
                            else
                            {
                                $scope.addStores.slideImage1.croppedImage = null;
                            }

                            if($scope.currentStore[0]['store_front_promotion']['image']['image3'])
                            {
                                $scope.addStores.slideImage2.croppedImage = $scope.currentStore[0]['store_front_promotion']['image']['image3']['large_image_url'];
                            }
                            else
                            {
                                $scope.addStores.slideImage2.croppedImage = null;
                            }

                            if($scope.currentStore[0]['store_front_promotion']['image']['image4'])
                            {
                                $scope.addStores.slideImage3.croppedImage = $scope.currentStore[0]['store_front_promotion']['image']['image4']['large_image_url'];
                            }
                            else
                            {
                                $scope.addStores.slideImage3.croppedImage = null;
                            }
                        }

                    }
                });
            }

        }

        $scope.StoreSubscriptionPayFree = function(subscriptiontype)
        {
            $scope.Selected_Store = $scope.currentStore[0];

            if(subscriptiontype == "free")
            {
                $scope.FreeAmt = $scope.Subscription_offer[0].amount;
            }
            else if(subscriptiontype == "premium")
            {
                $scope.PremiumAmt = $scope.Subscription_offer[1].amount;
            }
        }

        $scope.SubscriptionPay = function(subscriptiontype,amount)
        {

            $scope.Selected_Store = $scope.currentStore[0];
            
            if(subscriptiontype == "premium")
            {
                $scope.PremiumAmt = amount;
            }
            else if(subscriptiontype == "customized")
            {
                $scope.CutomizedAmt = amount;
            }
        }


        //users/store/get
        $scope.GetStoreListing();
        $scope.GetAllStores();
        $scope.GetStoreSubscription();
//        $scope.GetCategories();


    });

/*collage image crop section starts*/
evezownApp.controller('cropLeftCollageCtrl', function ($scope, StoreService,
                                                      usSpinnerService, ngDialog) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.setSelect = [0, 0, 1500, 1500];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 780 / 440;

    $scope.slideImage.boxWidth = 500;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 780 / 440;

    // Crop Title image
    $scope.uploadLeftCollage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Uploaded Left Collage');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});


evezownApp.controller('cropRightCollageCtrl', function ($scope, StoreService,
                                                      usSpinnerService, ngDialog) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.setSelect = [0, 0, 1500, 1500];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 386 / 220;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 386 / 220;

    // Crop Title image
    $scope.uploadRightCollage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Uploaded Right Collage');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('cropBottomCollageCtrl', function ($scope, StoreService,
                                                      usSpinnerService, ngDialog) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.setSelect = [0, 0, 1500, 1500];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 386 / 220;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 386 / 220;

    // Crop Title image
    $scope.uploadBottomCollage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Uploaded Bottom Collage');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('cropProfileCollageCtrl', function ($scope, StoreService,
                                                      usSpinnerService, ngDialog) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.setSelect = [0, 0, 1500, 1500];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 600 / 350;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 600 / 350;

    // Crop Title image
    $scope.uploadProfileCollage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Uploaded Profile Collage');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});
/*collage image crop section ends*/

/*Slide image crop section starts*/
evezownApp.controller('cropSlideImageCtrl', function ($scope, StoreService,
                                                      usSpinnerService, ngDialog) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.setSelect = [0, 0, 1500, 1500];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 1200 / 350;

    $scope.slideImage.boxWidth = 550;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 1200 / 350;

    // Crop Title image
    $scope.uploadSlideImage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Slide Image');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

/*evezownApp.controller('cropSlideImageCtrl', function ($scope, StoreService,
                                                      usSpinnerService, ngDialog) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 1200 / 350;

    $scope.slideImage.boxWidth = 550;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 1200 / 350;

    // Crop Title image
    $scope.uploadSlideImage = function () {
        if(!$scope.slideImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Slide Image');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});*/

evezownApp.controller('cropSlideImageCtrl1', function ($scope, StoreService,
                                                       usSpinnerService, ngDialog) {
    $scope.slideImage1 = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage1.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage1.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage1.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage1.thumbnail = false;

    $scope.slideImage1.aspectRatio = 1200 / 350;

    $scope.slideImage1.boxWidth = 550;

    $scope.slideImage1.cropConfig = {};

    $scope.slideImage1.cropConfig.aspectRatio = 1200 / 350;

    // Crop Title image
    $scope.uploadSlideImage1 = function () {
        if(!$scope.slideImage1.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage1.src),
            $scope.slideImage1.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Slide Image');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('cropSlideImageCtrl2', function ($scope, StoreService,
                                                       usSpinnerService, ngDialog) {
    $scope.slideImage2 = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage2.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage2.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage2.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage2.thumbnail = false;

    $scope.slideImage2.aspectRatio = 1200 / 350;

    $scope.slideImage2.boxWidth = 550;

    $scope.slideImage2.cropConfig = {};

    $scope.slideImage2.cropConfig.aspectRatio = 1200 / 350;

    // Crop Title image
    $scope.uploadSlideImage2 = function () {
        if(!$scope.slideImage2.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage2.src),
            $scope.slideImage2.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Slide Image');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('imagePreviewController', function ($scope,
                                                          ngDialog, imagePath) {
    $scope.imagePath = imagePath;
});


evezownApp.controller('imagePreviewController1', function ($scope,
                                                           ngDialog, imagePath) {
    $scope.imagePath1 = imagePath;
});

evezownApp.controller('imagePreviewController2', function ($scope,
                                                           ngDialog, imagePath) {
    $scope.imagePath2 = imagePath;
});

evezownApp.controller('imagePreviewController3', function ($scope,
                                                           ngDialog, imagePath) {
    $scope.imagePath3 = imagePath;
});

evezownApp.controller('cropSlideImageCtrl3', function ($scope, StoreService,
                                                       usSpinnerService, ngDialog) {
    $scope.slideImage3 = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage3.coords = [100, 100, 200, 200, 100, 100];
    $scope.slideImage3.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage3.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage3.thumbnail = false;

    $scope.slideImage3.aspectRatio = 1200 / 350;

    $scope.slideImage3.boxWidth = 550;

    $scope.slideImage3.cropConfig = {};

    $scope.slideImage3.cropConfig.aspectRatio = 1200 / 350;

    // Crop Title image
    $scope.uploadSlideImage3 = function () {
        if(!$scope.slideImage3.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage3.src),
            $scope.slideImage3.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Slide Image');
                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});