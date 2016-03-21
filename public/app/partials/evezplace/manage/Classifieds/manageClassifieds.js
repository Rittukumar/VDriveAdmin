/**
 * Created by Viswanathan on 7/15/2015.
 */

evezownApp
    .controller('ManageClassifiedCtrl', function ($scope, PATHS, $location, EvezplaceHomeService,
                                                  ngFabForm, ClassifiedsService, usSpinnerService,
                                                  $controller, $cookieStore, $sce, ngDialog, $filter,
                                                  $http, $routeParams) {
        $scope.title = 'Create Classified/Listing';
        $scope.description = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus at aut consectetur cum ' +
            'earum fugiat natus odit vel, vero voluptas? Accusantium assumenda commodi eaque, error libero ' +
            'quod soluta temporibus veritatis.';

        $scope.loggedInUserId = $cookieStore.get('userId');

        $scope.ImageUrlPath = PATHS.api_url + 'image/show/';

        $scope.addClassified = {};

        // Set defatult classified to new classified (value = 3)
        $scope.addClassified.classified_for = 3;

        // Set default layout type of classified to first layout (value = 1)
        $scope.addClassified.layoutType = 1;

        $scope.addClassified.classifiedDateRange = {startDate: new Date(), endDate: new Date()};


        $scope.addClassified.id = $routeParams.id;

        var classifiedId = $routeParams.id;

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
                $scope.addClassified.layoutType = data.layout_type;
                $scope.addClassified.classifiedTitle = data.title;
                $scope.addClassified.classifiedDesc = data.description;

                $scope.addClassified.titleImage = {};
                $scope.addClassified.titleImage.croppedImage = data.images[0].title_image_name;
                $scope.addClassified.bodyImage1 = {};
                $scope.addClassified.bodyImage1.croppedImage = data.images[0].body_image1_name;
                $scope.addClassified.bodyImage2 = {};
                $scope.addClassified.bodyImage2.croppedImage = data.images[0].body_image2_name;
                $scope.addClassified.bodyImage3 = {};
                $scope.addClassified.bodyImage3.croppedImage = data.images[0].body_image3_name;
                $scope.addClassified.bodyImage4 = {};
                $scope.addClassified.bodyImage4.croppedImage = data.images[0].body_image4_name;

                $scope.addClassified.dealDescription = data.deal_description;

                $scope.addClassified.contactDetails = {};
                $scope.addClassified.contactDetails.phoneNum = data.contact.phone;
                $scope.addClassified.contactDetails.email = data.contact.email;
                $scope.addClassified.contactDetails.name = data.contact.name;

                $scope.addClassified.storeLocation = {};
                $scope.addClassified.storeLocation.streetAddress = data.location.street_address;
                $scope.addClassified.storeLocation.cityState = data.location.city + ', ' + data.location.state;
                $scope.addClassified.storeLocation.pincode = data.location.pincode;

                // For step 3
                $scope.addClassified.step3 = {};
                $scope.addClassified.step3.classifiedId = data.id;
                $scope.addClassified.step3.is_my_eves = data.is_my_eves;
                $scope.addClassified.step3.is_my_circles = data.is_my_circles;
                $scope.addClassified.step3.is_only_me = data.is_only_me;
                $scope.addClassified.step3.is_open_to_public = data.is_open_to_public;
                //$scope.addClassified.step3.is_recco_it_channel = data.is_recco_it_channel;
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

        $scope.loadTags = function (query) {
            return $http.get(PATHS.api_url + 'tags/' + query);
        };

        function loadClassifiedTags(tags) {

            $scope.addClassified.tags = [];

            angular.forEach(tags, function (value) {
                console.log("Tag: " + value.tag.name);

                var tag = {};
                tag.name = value.tag.name;
                tag.id = value.tag.id;

                $scope.addClassified.tags.push(tag);
            });
        }

        $scope.tagRemoved = function (tag) {
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
                //if ($scope.addClassified.id == 0) {
                //    $cookieStore.put('createClassifiedId', data.id);
                //}

                usSpinnerService.stop('spinner-1');
                toastr.success('Ads & Campaigns updated successfully', 'Manage Ads & Campaigns');
                //$location.path('classifieds/create/step2');
            });
        }

        /* Save create classified step 2 */
        $scope.saveClassifiedsStep2 = function () {
            usSpinnerService.spin('spinner-1');
            ClassifiedsService.saveClassifiedsStep2($scope.addClassified, $scope.loggedInUserId).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success('Ads & Campaigns updated successfully', 'Manage Ads & Campaigns');
                //$location.path('classifieds/create/step3');
            });
        }

        /* Save create classified step 2 */
        $scope.saveClassifiedsStep3 = function () {
            usSpinnerService.spin('spinner-1');
            ClassifiedsService.saveClassifiedsStep3($scope.addClassified.step3, $scope.loggedInUserId).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success('Ads & Campaigns updated successfully', 'Manage Ads & Campaigns');
                // $location.path('classifieds/create/success');

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
                        imagePath: $scope.ImageUrlPath + imagePath
                    })
                });
        };

        function getAllClassifiedRfi(page) {
            ClassifiedsService.getRfiForClassified(classifiedId, page).
            then(function (data) {
                $scope.classifiedRfiCollection = data.data;
                $scope.rfiMeta = data.meta;
            });
        }

        getAllClassifiedRfi();

        $scope.loadMoreRfi = function (page) {
            console.log(page);
            getAllClassifiedRfi(page)
        };
    });

evezownApp.controller('cropTitleImageCtrl', function ($scope, ClassifiedsService,
                                                      usSpinnerService, ngDialog) {
    $scope.titleImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.titleImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.titleImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.titleImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.titleImage.thumbnail = false;

    $scope.titleImage.aspectRatio = 16 / 9;

    $scope.titleImage.boxWidth = 550;

    $scope.titleImage.cropConfig = {};

    $scope.titleImage.cropConfig.aspectRatio = 16 / 9;

    // Crop Title image
    $scope.uploadTitleImage = function () {
        if(!$scope.titleImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            ClassifiedsService.uploadTitleImage(
            getBase64Image($scope.titleImage.src),
            $scope.titleImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Title Image');

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

evezownApp.controller('cropBodyImageCtrl', function ($scope, ImageUploadService,
                                                     usSpinnerService, ngDialog) {
    $scope.bodyImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.bodyImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.bodyImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.bodyImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.bodyImage.thumbnail = false;

    $scope.bodyImage.aspectRatio = 16 / 9;

    $scope.bodyImage.boxWidth = 550;

    $scope.bodyImage.cropConfig = {};

    $scope.bodyImage.cropConfig.aspectRatio = 16 / 9;

    // Crop Title image
    $scope.uploadBodyImage = function () {
        if(!$scope.bodyImage.src)
        {
            toastr.error('Please select an image');
        }
        else
        {
            usSpinnerService.spin('spinner-1');
            ImageUploadService.cropImage(
            $scope.bodyImage.src,
            $scope.bodyImage.coords)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Upload Body Image');

                ngDialog.close("", data);
            }, function (error) {
                usSpinnerService.stop('spinner-1');
                toastr.error(error.message, 'Please crop the image before upload');
            });
        }
    }
});

evezownApp.controller('imagePreviewController', function ($scope,
                                                          ngDialog, imagePath) {
    $scope.imagePath = imagePath;
});


evezownApp.controller('createClassifiedsSuccessCtrl', function ($scope,
                                                                ngDialog, $cookieStore, $controller, $routeParams) {
    $scope.addClassified.id = $routeParams.id

    $scope.publishClassified = function () {
        var finishClassifiedDialog = ngDialog.open(
            {
                template: 'finishClassifiedDialogId',
                scope: $scope,
                className: 'ngdialog-theme-default',
                controller: $controller('finishClassifiedCtrl', {
                    $scope: $scope
                })
            });

        finishClassifiedDialog.closePromise.then(function (data) {
            console.log('Classified Finish: ' + data);
            toastr.success(data.message, 'Create Classified');
            // Clear the currently created classified id from cookie once classified is published.
            if ($scope.addClassified.id > 0 && data.value.status) {
                $cookieStore.remove('createClassifiedId');
                $location.path('/');
            }
        });
    }
});

evezownApp.controller('finishClassifiedCtrl', function ($scope, ngDialog, $cookieStore,
                                                        usSpinnerService, ClassifiedsService) {
    $scope.classifiedId = $cookieStore.get('createClassifiedId') == undefined
        ? 0 : $cookieStore.get('createClassifiedId');

    console.log($scope.classifiedId);

    $scope.publishToRecco = false;
    $scope.activateClassified = false;

    $scope.finishClassified = function ($status) {

        usSpinnerService.spin('spinner-1');

        var statusData = {status: $status};

        ClassifiedsService.updateStatus(statusData, $scope.classifiedId)
            .then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Finish Classified');

                ngDialog.close("", data);
            });
    }
});

