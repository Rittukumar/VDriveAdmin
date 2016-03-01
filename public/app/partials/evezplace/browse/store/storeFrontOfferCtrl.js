/**
 * Created by vishu on 06/11/15.
 */


evezownApp.controller('StoreFrontOfferController', function ($scope, PATHS, $routeParams) {
    $scope.myInterval = 5000;
    var storeId = $routeParams.id;

    $scope.isPromotionHidden = false;
    $scope.isTrendingHidden = false;
    function getStoreFrontDetails(storeId) {
        StoreService.getStoreFrontDetails(storeId).
        then(function (data) {

            var storeFrontDetails = data[0];

            $scope.slides = null;
            $scope.offerImages = null;


            if (storeFrontDetails.store_front_promotion) {
                if (storeFrontDetails.store_front_promotion.image.image1) {
                    if (storeFrontDetails.store_front_promotion.image.image1.large_image_url.indexOf('http://') === 0 || storeFrontDetails.store_front_promotion.image.image1.large_image_url.indexOf('https://') === 0) {
                        $scope.slides = [storeFrontDetails.store_front_promotion.image.image1.large_image_url];
                    }
                    else {
                        $scope.slides = [PATHS.api_url + 'image/show/' + storeFrontDetails.store_front_promotion.image.image1.large_image_url + '/1200/350'];
                    }


                    if (storeFrontDetails.store_front_promotion.image.image2) {
                        if (storeFrontDetails.store_front_promotion.image.image2.large_image_url.indexOf('http://') === 0 || storeFrontDetails.store_front_promotion.image.image2.large_image_url.indexOf('https://') === 0) {
                            $scope.slides.push(storeFrontDetails.store_front_promotion.image.image2.large_image_url);
                        }
                        else {
                            $scope.slides.push(PATHS.api_url + 'image/show/' + storeFrontDetails.store_front_promotion.image.image2.large_image_url + '/1200/350');
                        }
                    }
                    if (storeFrontDetails.store_front_promotion.image.image3) {
                        if (storeFrontDetails.store_front_promotion.image.image3.large_image_url.indexOf('http://') === 0 || storeFrontDetails.store_front_promotion.image.image3.large_image_url.indexOf('https://') === 0) {
                            $scope.slides.push(storeFrontDetails.store_front_promotion.image.image3.large_image_url);
                        }
                        else {
                            $scope.slides.push(PATHS.api_url + 'image/show/' + storeFrontDetails.store_front_promotion.image.image3.large_image_url + '/1200/350');
                        }
                    }

                    if (storeFrontDetails.store_front_promotion.image.image4) {
                        if (storeFrontDetails.store_front_promotion.image.image4.large_image_url.indexOf('http://') === 0 || storeFrontDetails.store_front_promotion.image.image4.large_image_url.indexOf('https://') === 0) {
                            $scope.slides.push(storeFrontDetails.store_front_promotion.image.image4.large_image_url);
                        }
                        else {
                            $scope.slides.push(PATHS.api_url + 'image/show/' + storeFrontDetails.store_front_promotion.image.image4.large_image_url + '/1200/350');
                        }
                    }
                }
                else {
                    $scope.isPromotionHidden = true;
                }

            }

            if (storeFrontDetails.trending_products.length > 0) {

                angular.forEach(storeFrontDetails.trending_products, function (value, key) {

                    if ($scope.offerImages) {
                        $scope.offerImages.push({
                            imageName: PATHS.api_url + 'image/show/' +
                            value.images[0].large_image_url,
                            title: value.details.title,
                            price: value.price,
                            id: value.product_id
                        });
                    }
                    else {
                        $scope.offerImages = [{
                            imageName: PATHS.api_url + 'image/show/' +
                            value.images[0].large_image_url,
                            title: value.details.title,
                            price: value.price,
                            id: value.product_id
                        }];
                    }

                });
            }
            else {
                $scope.isTrendingHidden = true;
            }
        });
    }

    getStoreFrontDetails(storeId);
});

