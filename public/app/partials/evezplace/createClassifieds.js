/**
 * Created by Viswanathan on 7/7/2015.
 */

evezownApp.controller('CreateClassifiedsCtrl', function ($scope, PATHS, $location, EvezplaceHomeService,
                                                         ngFabForm, ClassifiedsService, usSpinnerService,
                                                         $controller, $cookieStore, $sce, ngDialog,
                                                         $filter,$http, StoreService) {
    $scope.title = 'Create Classified/Listing';
    $scope.description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus at aut consectetur cum ' +
        'earum fugiat natus odit vel, vero voluptas? Accusantium assumenda commodi eaque, error libero ' +
        'quod soluta temporibus veritatis.';

    $scope.loggedInUserId = $cookieStore.get('userId');

    $scope.addClassified = {};

    $scope.imageUrlPath = PATHS.api_url + 'image/show/';

    // Set defatult classified to new classified (value = 3)
    $scope.addClassified.classified_for = 3;

    // Set default layout type of classified to first layout (value = 1)
    $scope.addClassified.layoutType = 1;

    $scope.addClassified.classifiedDateRange = {startDate: new Date(), endDate: new Date()};


    $scope.addClassified.id = $cookieStore.get('createClassifiedId') == undefined
        ? 0 : $cookieStore.get('createClassifiedId');

    $scope.createStoreNavLinks = [{
        Title: 'step1',
        LinkText: 'Step1'
    }, {
        Title: 'step2',
        LinkText: 'Step2'
    }, {
        Title: 'step3',
        LinkText: 'Step3'
    }];

    $scope.specifyItems = [
        {"id": 1, "name": "product"},
        {"id": 2, "name": "service"}
    ];

    $scope.createStoreNavClass = function (page) {

        var currentRoute = $location.path().substring(1) || 'home';

        return page === currentRoute ? 'active' : '';
    };

    //$scope.loadTags = function(query) {
    //    return $http.get('/tags?query=' + query);
    //};

    //Loading subcategories based on categoryId
    $scope.GetSubCategories = function (cat_id) {
        EvezplaceHomeService.getSubcategories(cat_id).
            then(function (data) {
                $scope.subcategories = data;
            });
    }

    $scope.GetCategories = function () {
        EvezplaceHomeService.getCategories(5).
            then(function (data) {
                $scope.categories = data;
            });
    }


    $scope.GetCategories();

    function getClassified(classifiedId) {
        ClassifiedsService.getClassified(classifiedId).
            then(function (data) {

                // For step 1
                $scope.addClassified.classified_for = data.classified_for;
                $scope.addClassified.classified_category_id = data.classified_category_id;
                $scope.addClassified.classified_subcategory_id = data.classified_subcategory_id;
                $scope.addClassified.classified_type = data.classified_type;

                //    $filter('filter')($scope.specifyItems, function (specify) {
                //    return specify.id = data.classified_type;
                //})[0];

                $scope.addClassified.classifiedDateRange = {};
                $scope.addClassified.classifiedDateRange.startDate = data.start_date;
                $scope.addClassified.classifiedDateRange.endDate = data.end_date;

                loadClassifiedTags(data.tags);

                // For step 2
               
                if(data.layout_type !=null)
                { $scope.addClassified.layoutType = data.layout_type; }
                $scope.addClassified.classifiedTitle = data.title;
                $scope.addClassified.classifiedDesc = data.description;

                $scope.addClassified.titleImage = {};
                $scope.addClassified.titleImage.croppedImage = (data.images[0] == undefined)?"":data.images[0].title_image_name;
                $scope.addClassified.bodyImage1 = {};
                $scope.addClassified.bodyImage1.croppedImage = (data.images[0] == undefined)?"":data.images[0].body_image1_name;
                $scope.addClassified.bodyImage2 = {};
                $scope.addClassified.bodyImage2.croppedImage = (data.images[0] == undefined)?"":data.images[0].body_image2_name;
                $scope.addClassified.bodyImage3 = {};
                $scope.addClassified.bodyImage3.croppedImage = (data.images[0] == undefined)?"":data.images[0].body_image3_name;
                $scope.addClassified.bodyImage4 = {};
                $scope.addClassified.bodyImage4.croppedImage = (data.images[0] == undefined)?"":data.images[0].body_image4_name;

                $scope.addClassified.dealDescription = (data.deal_description == null)?"":data.deal_description;

                $scope.addClassified.contactDetails = {};
                $scope.addClassified.contactDetails.phoneNum = (data.contact == null)?"":data.contact.phone;
                $scope.addClassified.contactDetails.email = (data.contact == null)?"":data.contact.email;
                $scope.addClassified.contactDetails.name = (data.contact == null)?"":data.contact.name;

                $scope.addClassified.storeLocation = {};
                $scope.addClassified.storeLocation.streetAddress = (data.location == null)?"":data.location.street_address;
                $scope.addClassified.storeLocation.cityState = (data.location == null)?"":data.location.city + ', ' + data.location.state;
                $scope.addClassified.storeLocation.pincode = (data.location == null)?"":data.location.pincode;

                // For step 3
                $scope.addClassified.step3 = {};
                $scope.addClassified.step3.classifiedId = data.id;
                $scope.addClassified.step3.is_my_eves = data.is_my_eves;
                $scope.addClassified.step3.is_my_circles = data.is_my_circles;
                $scope.addClassified.step3.is_only_me = data.is_only_me;
                $scope.addClassified.step3.is_open_to_public = data.is_open_to_public;
                $scope.addClassified.step3.is_recco_it_channel = data.is_recco_it_channel;
                $scope.addClassified.step3.is_add_enquiry = data.is_add_enquiry;
                $scope.addClassified.step3.is_sends_analytics = data.is_sends_analytics;
                $scope.addClassified.step3.is_views_analytics = data.is_views_analytics;
                $scope.addClassified.step3.is_visibility_summary_analytics = data.is_visibility_summary_analytics;
                $scope.addClassified.step3.is_enquires_analytics = data.is_enquires_analytics;
                $scope.addClassified.step3.is_gradeit_analytics = data.is_gradeit_analytics;
                $scope.addClassified.step3.is_facebook_share = data.is_facebook_share;
                $scope.addClassified.step3.is_gmail_share = data.is_gmail_share;
                $scope.addClassified.step3.is_email_share = data.is_email_share;
                $scope.addClassified.step3.is_googleplus_share = data.is_googleplus_share;
                $scope.addClassified.step3.is_linkedin_share = data.is_linkedin_share;
                $scope.addClassified.step3.is_twitter_share = data.is_twitter_share;
                $scope.addClassified.step3.is_watsapp_share = data.is_watsapp_share;
                $scope.addClassified.step3.is_direct_message_share = data.is_direct_message_share;

                $scope.GetSubCategories($scope.addClassified.classified_category_id);
            });
    }

    function getUserStores(userId) {
        StoreService.getUserStores(userId).
            then(function (data) {
                $scope.userStores = data;
            });
    }

    getUserStores();

    $scope.loadTags = function(query) {
        return $http.get(PATHS.api_url + 'tags/' + query);
    };

    function loadClassifiedTags (tags) {

        $scope.addClassified.tags = [];

        angular.forEach(tags, function(value) {
            console.log("Tag: " + value.tag.name);

            var tag = {};
            tag.name = value.tag.name;
            tag.id = value.tag.id;

            $scope.addClassified.tags.push(tag);
        });
    }

    $scope.tagRemoved = function(tag) {
        console.log('Removed: Name - ' + tag.name + ' Id -' + tag.id);

        usSpinnerService.spin('spinner-1');
        ClassifiedsService.removeTag(tag.id).then(function (data) {
            usSpinnerService.stop('spinner-1');
            toastr.success(data.message, 'Create Ads & Campaigns');
        });
    };

    if ($scope.addClassified.id > 0) {
        getClassified($scope.addClassified.id);
    }

    $scope.defaultFormOptions = ngFabForm.config;
    $scope.customFormOptions = angular.copy(ngFabForm.config);

    /* Save create classified step 1 */
    $scope.saveClassifiedsStep1 = function () {
        usSpinnerService.spin('spinner-1');
        ClassifiedsService.saveClassifiedsStep1($scope.addClassified, $scope.loggedInUserId).then(function (data) {
            if ($scope.addClassified.id == 0) {
                $cookieStore.put('createClassifiedId', data.id);
                $cookieStore.put('PublishClassifiedId', data.id);
            }

            usSpinnerService.stop('spinner-1');
            toastr.success(data.message, 'Create Ads & Campaigns');
            $location.path('classifieds/create/step2');
        });
    }

    /* Save create classified step 2 */
    $scope.saveClassifiedsStep2 = function () {

        var Email = $scope.addClassified.contactDetails.email;
        var CheckEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!CheckEmail.test(Email))
        {
            toastr.error("please enter a valid Email")
        }

        else if(!$scope.addClassified.titleImage.croppedImage)
        {
            toastr.error('Please upload a title image')
        }
        else if(!$scope.addClassified.bodyImage1.croppedImage)
        {
            toastr.error('Please upload slide image 1')
        }
        else if(!$scope.addClassified.bodyImage2.croppedImage)
        {
            toastr.error('Please upload slide image 2')
        }
        else if(!$scope.addClassified.bodyImage3.croppedImage)
        {
            toastr.error('Please upload slide image 3')
        }
        else if(!$scope.addClassified.bodyImage4.croppedImage)
        {
            toastr.error('Please upload slide image 4')
        }
        else{
        usSpinnerService.spin('spinner-1');
        ClassifiedsService.saveClassifiedsStep2($scope.addClassified, $scope.loggedInUserId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            toastr.success(data.message, 'Create Ads & Campaigns');
            $location.path('classifieds/create/step3');
        });
        }
    }

    /* Save create classified step 2 */
    $scope.saveClassifiedsStep3 = function () {
        usSpinnerService.spin('spinner-1');
        ClassifiedsService.saveClassifiedsStep3($scope.addClassified.step3, $scope.loggedInUserId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            toastr.success(data.message, 'Create Ads & Campaigns');
            $cookieStore.remove('createClassifiedId');
            $location.path('classifieds/create/success');

        });
    }

    // Delete the cookie and related data of the classified.
    $scope.discardClassified = function () {
        if ($scope.addClassified.id > 0) {
            $cookieStore.remove('createClassifiedId');
        }
    }

    $scope.trustSrc = function (src) {
        return $sce.trustAsResourceUrl(src);
    }

    $scope.selection = [10, 10, 20, 20, 100, 80];

    /* Title image */

    $scope.CropTitleImage = function () {
    
        var cropTitleImageDialog = ngDialog.open(
            {
                template: 'cropTitleImageDialogId',
                scope: $scope,
                className: 'ngdialog-theme-plain',
                controller: $controller('cropTitleImageCtrl', {
                    $scope: $scope
                })
            });

        cropTitleImageDialog.closePromise.then(function (data) {
            console.log('Crop Title Image Response: ' + data);

            if (data.value.status) {
                $scope.addClassified.titleImage = {};
                $scope.addClassified.titleImage.croppedImage = data.value.imageName;
            }

        });
    }

    /* Body image 1 */

    $scope.CropBodyImage1 = function () {
        var cropBodyImageDialog = ngDialog.open(
            {
                template: 'cropBodyImageDialogId',
                scope: $scope,
                className: 'ngdialog-theme-plain',
                controller: $controller('cropBodyImageCtrl', {
                    $scope: $scope
                })
            });

        cropBodyImageDialog.closePromise.then(function (data) {
            console.log('Crop Body Image Response: ' + data);

            if (data.value.status) {
                $scope.addClassified.bodyImage1 = {};
                $scope.addClassified.bodyImage1.croppedImage = data.value.imageName;
            }
        });
    };

    $scope.CropBodyImage2 = function () {
        var cropBodyImageDialog = ngDialog.open(
            {
                template: 'cropBodyImageDialogId',
                scope: $scope,
                className: 'ngdialog-theme-plain',
                controller: $controller('cropBodyImageCtrl', {
                    $scope: $scope
                })
            });

        cropBodyImageDialog.closePromise.then(function (data) {
            console.log('Crop Body Image Response: ' + data);

            if (data.value.status) {
                $scope.addClassified.bodyImage2 = {};
                $scope.addClassified.bodyImage2.croppedImage = data.value.imageName;
            }
        });
    };

    $scope.CropBodyImage3 = function () {
        var cropBodyImageDialog = ngDialog.open(
            {
                template: 'cropBodyImageDialogId',
                scope: $scope,
                className: 'ngdialog-theme-plain',
                controller: $controller('cropBodyImageCtrl', {
                    $scope: $scope
                })
            });

        cropBodyImageDialog.closePromise.then(function (data) {
            console.log('Crop Body Image Response: ' + data);

            if (data.value.status) {
                $scope.addClassified.bodyImage3 = {};
                $scope.addClassified.bodyImage3.croppedImage = data.value.imageName;
            }
        });
    };

    $scope.CropBodyImage4 = function () {
        var cropBodyImageDialog = ngDialog.open(
            {
                template: 'cropBodyImageDialogId',
                scope: $scope,
                className: 'ngdialog-theme-plain',
                controller: $controller('cropBodyImageCtrl', {
                    $scope: $scope
                })
            });

        cropBodyImageDialog.closePromise.then(function (data) {
            console.log('Crop Body Image Response: ' + data);

            if (data.value.status) {
                $scope.addClassified.bodyImage4 = {};
                $scope.addClassified.bodyImage4.croppedImage = data.value.imageName;
            }
        });
    };

    //Image preview dialog.
    $scope.ImagePreview = function (imagePath) {
        ngDialog.open(
            {
                template: 'imagePreviewDialogId',
                scope: $scope,
                className: 'ngdialog-theme-plain',
                controller: $controller('imagePreviewController', {
                    $scope: $scope,
                    imagePath: $scope.imageUrlPath+imagePath
                })
            });
    };
});

evezownApp.controller('cropTitleImageCtrl', function ($scope, ClassifiedsService,
                                                      usSpinnerService, ngDialog) {
    $scope.titleImage = {};
    // Must be [x, y, x2, y2, w, h]

    

    $scope.titleImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.selection = coords;
    };

    // You can add a thumbnail if you want
    $scope.titleImage.thumbnail = false;

    $scope.titleImage.aspectRatio = 16 / 9;

    $scope.titleImage.boxWidth = 550;

    $scope.titleImage.cropConfig = {};

    $scope.titleImage.cropConfig.aspectRatio = 16 / 9;

    // Crop Title image
    $scope.uploadTitleImage = function () {

        usSpinnerService.spin('spinner-1');

        ClassifiedsService.uploadTitleImage(
            getBase64Image($scope.titleImage.src),
            $scope.selection)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Title Image');

                ngDialog.close("", data);
            });
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('cropBodyImageCtrl', function ($scope, ImageUploadService,
                                                     usSpinnerService, ngDialog) {
    $scope.bodyImage = {};
    // Must be [x, y, x2, y2, w, h]

    $scope.selection = [10, 10, 20, 20, 100, 80];

    $scope.bodyImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.selection = coords;
    };

    // You can add a thumbnail if you want
    $scope.bodyImage.thumbnail = false;

    $scope.bodyImage.aspectRatio = 16 / 9;

    $scope.bodyImage.boxWidth = 550;

    $scope.bodyImage.cropConfig = {};

    $scope.bodyImage.cropConfig.aspectRatio = 16 / 9;

    // Crop Title image
    $scope.uploadBodyImage = function () {

        usSpinnerService.spin('spinner-1');



        ImageUploadService.cropImage(
            $scope.bodyImage.src,
            $scope.selection)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Body Image');

                ngDialog.close("", data);
            });
    }
});

evezownApp.controller('imagePreviewController', function ($scope,
                                                          ngDialog, imagePath) {
    $scope.imagePath = imagePath;
});


evezownApp.controller('ClassifiedsSuccessCtrl', function ($scope,
                                                                ngDialog, $cookieStore, $controller, $location) {
    $scope.addClassified.id = $cookieStore.get('PublishClassifiedId') == undefined
        ? 0 : $cookieStore.get('PublishClassifiedId');
    
    $scope.publishClassified = function() {
        var finishClassifiedDialog = ngDialog.open(
            {
                template: 'finishClassifiedDialogId',
                scope: $scope,
                className: 'ngdialog-theme-default',
                controller: $controller('finishCreateClassifiedCtrl', {
                    $scope: $scope
                })
            });

        finishClassifiedDialog.closePromise.then(function (data) {
            console.log('Classified Finish: ' + data);
            $location.path('classifieds/browse');
        });
    }
});

evezownApp.controller('finishCreateClassifiedCtrl', function ($scope, ngDialog, $cookieStore,
                                                        usSpinnerService, ClassifiedsService) {
    $scope.classifiedId = $cookieStore.get('PublishClassifiedId') == undefined
        ? 0 : $cookieStore.get('PublishClassifiedId');

    console.log($scope.classifiedId);

    $scope.publishToRecco = false;
    $scope.activateClassified = false;

    $scope.finishClassified = function($status) {

        usSpinnerService.spin('spinner-1');

        var statusData = {status : $status};

        ClassifiedsService.updateStatus(statusData, $scope.classifiedId)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Finish Classified');

                ngDialog.close("", data);
            });
    }
});
