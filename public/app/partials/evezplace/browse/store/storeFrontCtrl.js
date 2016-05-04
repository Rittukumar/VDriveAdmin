/**
 * Created by vishu on 06/11/15.
 */

evezownApp.controller('StoreFrontController', function ($scope, ngDialog, $filter,
                                                        ngTableParams, $cookieStore,
                                                        $routeParams, StoreService,
                                                        PATHS, $controller, $http, $window) {

    $scope.storefront = $scope.storefront || {};

    $scope.storefront.collageImages = [];

    $scope.loggedInUserId = $cookieStore.get('userId');

    $scope.storeOwnerId = -1;

    $scope.imageUrl = PATHS.api_url + 'image/show/';

    var storeId = $routeParams.id;

    $scope.PageSource = $routeParams.pagesrc;


    function getStoreFrontDetails(storeId) {
        StoreService.getStoreFrontDetails(storeId).
        then(function (data) {

            var storeFrontDetails = data[0];

            $scope.storefront.owner_id = storeFrontDetails.owner_id;
            $scope.storefront.id = storeFrontDetails.id;

            $scope.storefront.storeAdvertising = storeFrontDetails.store_advertising;

            $scope.isStoreOwner = ($scope.storefront.owner_id == $scope.loggedInUserId);

            $scope.storefront.title = storeFrontDetails.title;
            $scope.storefront.description = storeFrontDetails.description;
            $scope.storefront.aboutus = storeFrontDetails.store_about_us || '';
            if (storeFrontDetails.profile_images != null &&
                storeFrontDetails.profile_images.large_image_url != '') {
                $scope.storefront.profile_image = 
                    storeFrontDetails.profile_images.large_image_url;
            }
            else {
                $scope.storefront.profile_image = 'http://placehold.it/288x288/e50880/ffffff';
            }

            if (storeFrontDetails.collage_image1 != null &&
                storeFrontDetails.collage_image1.large_image_url != '') {
                $scope.storefront.collageImages.push(
                    storeFrontDetails.collage_image1.large_image_url);
            }
            else {
                $scope.storefront.collageImages.push('http://placehold.it/780x520/e50880/ffffff');
            }

            if (storeFrontDetails.collage_image2 != null &&
                storeFrontDetails.collage_image2.large_image_url != '') {
                $scope.storefront.collageImages.push(
                    storeFrontDetails.collage_image2.large_image_url);
            }
            else {
                $scope.storefront.collageImages.push('http://placehold.it/390x250/e50880/ffffff');
            }

            if (storeFrontDetails.collage_image3 != null &&
                storeFrontDetails.collage_image3.large_image_url != '') {
                $scope.storefront.collageImages.push(
                    storeFrontDetails.collage_image3.large_image_url);
            }
            else {
                $scope.storefront.collageImages.push('http://placehold.it/390x250/e50880/ffffff');
            }

            if (storeFrontDetails.store_front_info.target_audience != '') {
                $scope.storefront.target_audience =
                    storeFrontDetails.store_front_info.target_audience;
            }

            if (storeFrontDetails.store_front_info.offerings != '') {
                $scope.storefront.offerings =
                    storeFrontDetails.store_front_info.offerings;
            }

            if (storeFrontDetails.store_front_info.motto != '') {
                $scope.storefront.motto =
                    storeFrontDetails.store_front_info.motto;
            }

            if (storeFrontDetails.store_front_info.vision != '') {
                $scope.storefront.vision =
                    storeFrontDetails.store_front_info.vision;
            }

            if (storeFrontDetails.store_front_info.purpose != '') {
                $scope.storefront.purpose =
                    storeFrontDetails.store_front_info.purpose;
            }

            $scope.storefront.contactDetails = [];

            $scope.storefront.contactDetails = {
                address: storeFrontDetails.street_address,
                city: storeFrontDetails.city,
                state: storeFrontDetails.state,
                country: storeFrontDetails.country,
                pincode: storeFrontDetails.zip,
                primary_phone: storeFrontDetails.store_front_info.store_contact_phone1,
                secondary_phone: storeFrontDetails.store_front_info.store_contact_phone2,
                email: storeFrontDetails.store_front_info.email_address
            };

            $scope.storefront.DisclosureLink = [];

            $scope.storefront.DisclosureLink = {
                
                Link1: storeFrontDetails.store_front_info.store_mandatory_disclosure_link1,
                Link2: storeFrontDetails.store_front_info.store_mandatory_disclosure_link2,
                Link3: storeFrontDetails.store_front_info.store_mandatory_disclosure_link3
            };

            $scope.storefront.privacy = storeFrontDetails.store_front_info.store_policies;

            $scope.storefront.terms = storeFrontDetails.store_front_info.store_terms_conditions;

            $scope.storefront.shippingReturn = storeFrontDetails.store_front_info.store_sales_exchange_policy;


        });
    }

    getStoreFrontDetails(storeId);

    function getProducts(storeId) {
        StoreService.getProductLines(storeId).
        then(function (data) {
            var productlines = data;

            $scope.storefront.productLines = productlines;
        });
    }

    getProducts(storeId);

    $scope.selectedProductLine = {};


    $scope.getProducts = function (productLine) {
        $scope.storefront.products = productLine.products;
    }

    $scope.openPriceList = function() {
        console.log($scope.storefront.storeAdvertising);
        $window.open(PATHS.api_url + $scope.storefront.storeAdvertising.store_price_list);
    }


    $scope.PublishStore = function (storeId) {
        ngDialog.open({template: 'statustemplateId'});
    }

    $scope.Publish = function (storeId) {
        $http.post(PATHS.api_url + 'users/store/updatestorestatus/update'
            , {
                data: {
                    StoreId: $routeParams.id,
                    storeStatus: 8
                },
                headers: {'Content-Type': 'application/json'}
            }).
        success(function (data, status, headers, config) {
            toastr.success(data.message, 'Store');

        }).error(function (data) {
            toastr.error(data.error.message, 'Store');
        }).then(function () {
            ngDialog.close();
        });
    }

    $scope.CancelPublish = function (storeId) {
        ngDialog.close();
    }


    $scope.GetStoreStatus = function (storeId) {

    }

    $scope.openRequestForQueryForm = function () {

        var id = storeId;
        var storeRfqDialog = ngDialog.open(
            {
                template: 'partials/evezplace/browse/store/store_rfq_dialog.html',
                className: 'ngdialog-theme-plain',
                scope: $scope,
                controller: $controller('storeRfqCtrl', {
                    $scope: $scope,
                    storeId: id
                })
            });

        storeRfqDialog.closePromise.then(function (data) {

            if (data.value.status) {
                toastr.success(data.message, 'Store rfq submitted successfully.');
            }
        });
    };

    $scope.datepickers = {
        expectedDeliveryDate: false,
        expectedPurchaseDate: false
    };

    $scope.formData = {};

    $scope.selectedProduct = null;
    $scope.selectedQuantity = null;
    $scope.selectedDeliveryCity = null;

    // The loaded comments for the store will be passed to the directive.
    function loadStoreComments(page) {
        StoreService.getStoreComments(storeId, page).
        then(function (data) {
            var comments = data.data;

            $scope.commentMetadata = data.meta;
            $scope.storeComments = comments;
        });
    }

    function loadStoreGrades() {
        StoreService.getStoreGrades(storeId, $scope.loggedInUserId).
        then(function (data) {
            var gradeData = data;

            $scope.totalGrade = gradeData.grades.length;

            $scope.userGrade = gradeData.user_grade;

            $scope.avgGrade = gradeData.avg_grade;
        });
    }

    function loadStoreRestreams() {
        StoreService.getStoreRestreams(storeId).
        then(function (data) {
            $scope.totalRestreams = data;
        });
    }

    loadStoreComments(1);

    loadStoreGrades();

    loadStoreRestreams();

    $scope.loadComments = function (page) {
        console.log(page);
        loadStoreComments(page)
    };

    // This method call is happening from the directive and the
    // new comment is received from there.
    $scope.addComment = function (comment) {
        console.log(comment);

        StoreService.addComment(storeId, $scope.loggedInUserId, comment).
        then(function (data) {
            var result = data;

            console.log(result);

            if (result.status) {
                toastr.success(data.message, 'Store Comment');
                loadStoreComments();
            }
        });
    };

    $scope.updateComment = function (commentId, comment) {

        console.log(commentId + ' ' + comment);

        StoreService.updateComment(commentId, comment).
        then(function (data) {
            var result = data;

            console.log(result);

            if (result.status) {
                toastr.success(data.message, 'Store Comment');
                loadStoreComments();
            }
        });
    };

    $scope.deleteComment = function (id) {

        console.log(id);

        StoreService.deleteComment(id).
        then(function (data) {
            var result = data;

            console.log(result);

            if (result.status) {
                toastr.success(data.message, 'Store Comment');
                loadStoreComments();
            }
        });
    };

    $scope.addGrade = function (grade) {
        console.log(grade);

        StoreService.addGrade(storeId, $scope.loggedInUserId, grade).
        then(function (data) {
            var result = data;

            console.log(result);

            if (result.status) {
                toastr.success(data.message, 'Store Grade');
                loadStoreGrades();
            }
        });
    };

    $scope.addRestream = function () {

        StoreService.restreamStore(storeId, $scope.loggedInUserId).
        then(function (data) {
            var result = data;

            console.log(result);

            if (result.status) {
                toastr.success(data.message, 'Store Restream');

                loadStoreRestreams();
            }
        });
    };
});
