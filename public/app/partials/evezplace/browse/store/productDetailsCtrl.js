/**
 * Created by vishu on 06/11/15.
 */


evezownApp.controller('ProductDetailsCtrl', function ($scope, $rootScope, ngDialog, $filter,
                                                      $controller, StoreService, $location,
                                                      $routeParams, PATHS, $cookieStore) {

    $scope.imageUrl = PATHS.api_url + 'image/show/';

    var shoppingCartItems = $cookieStore.get('shoppingCartItems') || [];

    $scope.productDetails = {};

    $scope.productSkuVariants = null;


    $scope.productDetails.hasRelatedProducts = false;

    $scope.selectedProduct = {};
    $scope.selectedProduct.color = "";
    $scope.selectedProduct.size = "";
    $scope.selectedProduct.volume = "";
    $scope.selectedProduct.weight = "";

    $scope.productDetails.size_options = [];
    $scope.productDetails.color_options = [];
    $scope.productDetails.volume_options = [];
    $scope.productDetails.weight_options = [];

    var productId = $routeParams.id;

    function getProductDetails(productId) {
        StoreService.getProductDetails(productId).
        then(function (data) {
            var productDetails = data[0];

            $scope.isAlreadyAddedToCart = false;

            $scope.productDetails.id = productId;

            $scope.productDetails.store = {
                'id': productDetails.product_line.store.id,
                'name': productDetails.product_line.store.title
            };

            var currentStore = $filter('filter')(shoppingCartItems, {storeId: $scope.productDetails.store.id}, true);

            console.log('current store ', currentStore);

            if (currentStore.length > 0) {

                angular.forEach(currentStore[0].products, function (value, key) {
                    if (value.product_id == productId) {
                        $scope.isAlreadyAddedToCart = true;
                    }
                });
            }

            $scope.productDetails.title = productDetails.title;
            $scope.productDetails.description = productDetails.description;
            $scope.productDetails.price = productDetails.product_sk_u[0].price;
            $scope.productDetails.images = [];

            $scope.productDetails.related_products = [{
                'id': 1,
                'title': "Shoe #1",
                'price': '1200',
                'imagePath': 'http://www.wearingideas.com/wp-content/uploads/2015/05/shoes-for-women-11.jpg'
            }, {
                'id': 2,
                'title': "Shoe #2",
                'price': '2300',
                'imagePath': 'https://ankitakaul.files.wordpress.com/2013/03/louboutin.jpg'
            }, {
                'id': 3,
                'title': "Shoe #3",
                'price': '1700',
                'imagePath': 'http://www.uponshoes.org/wp-content/uploads/2014/09/shoes-for-womens.jpg'
            }, {
                'id': 4,
                'title': "Shoe #4",
                'price': '1600',
                'imagePath': 'http://www.fordress.net/img/Wicked-womens-shoes-Photo.jpg'
            }];

            angular.forEach(productDetails.product_sk_u[0].product_images, function (value, key) {
                $scope.productDetails.images.push(PATHS.api_url + 'image/show/' +
                    value.image.large_image_url + '/522/600');
            });
        });
    }

    // Load the product variants based on a chosen variant.
    function getProductVariants() {
        StoreService.getProductVariants(productId, $scope.selectedProduct).
        then(function (data) {
            $scope.productSkuVariants = data;

            if ($scope.productSkuVariants.length > 0) {

                if ($scope.selectedProduct.color == '')
                    $scope.productDetails.color_options = [];

                if ($scope.selectedProduct.size == '')
                    $scope.productDetails.size_options = [];

                $scope.productDetails.volume_options = [];
                $scope.productDetails.weight_options = [];

                angular.forEach($scope.productSkuVariants, function (value, key) {

                    if ($scope.selectedProduct.color == '' && value.color != '' &&
                        $scope.productDetails.color_options.indexOf(value.color) == -1) {
                        $scope.productDetails.color_options.push(value.color);
                    }

                    if ($scope.selectedProduct.size == '' &&
                        value.size != '' && $scope.productDetails.size_options.indexOf(value.size) == -1) {
                        $scope.productDetails.size_options.push(value.size);
                    }

                    if (value.weight != '0.00' &&
                        $scope.productDetails.weight_options.indexOf(value.weight) == -1) {
                        $scope.productDetails.weight_options.push(value.weight);
                    }

                    if (value.volume != '0.00' &&
                        $scope.productDetails.volume_options.indexOf(value.volume) == -1) {
                        $scope.productDetails.volume_options.push(value.volume);
                    }
                });

                var currentProductSku = $scope.productSkuVariants[0];

                $scope.productDetails.price = currentProductSku.price;

                $scope.productDetails.isInStock = currentProductSku.product_stock.quantity > 0;

                $scope.productDetails.images = [];

                angular.forEach(currentProductSku.product_images, function (value, key) {
                    $scope.productDetails.images.push(PATHS.api_url + 'image/show/' +
                        value.image.large_image_url + '/522/600');
                });
            }
        });
    }

    getProductDetails(productId);

    getProductVariants();

    $scope.selectColorOption = function (colorOption) {
        $scope.selectedProduct.color = colorOption;

        $scope.selectedProduct.size = '';

        $scope.selectedProduct.weight = '';

        $scope.selectedProduct.volume = '';

        getProductVariants();
    };

    $scope.selectSizeOption = function (currentSize) {

        $scope.selectedProduct.size = currentSize;

        $scope.selectedProduct.weight = '';

        $scope.selectedProduct.volume = '';

        getProductVariants();
    }

    $scope.formData = {};

    $scope.openRequestInfoForm = function (id) {
        var productRfiDialog = ngDialog.open(
            {
                template: 'partials/evezplace/browse/store/product_rfi_dialog.html',
                className: 'ngdialog-theme-plain',
                scope: $scope,
                controller: $controller('ProductRfiCtrl', {
                    $scope: $scope,
                    productId: id
                })
            });

        productRfiDialog.closePromise.then(function (data) {

            if (data.value.status) {
                toastr.success(data.message, 'Product rfi submitted successfully.');
            }
        });
    }

    $scope.datepickers = {
        expectedDeliveryDate: false,
        expectedPurchaseDate: false
    }

    $scope.today = function () {
        $scope.formData.expectedDeliveryDate = $filter('date')(new Date(), "dd-MMMM-yyyy");
        $scope.formData.expectedPurchaseDate = $filter('date')(new Date(), "dd-MMMM-yyyy");
    };


    $scope.today();

    $scope.clear = function () {
        $scope.formData.expectedDeliveryDate = null;
    };

    // Disable weekend selection
    $scope.disabled = function (date, mode) {
        return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    };

    $scope.toggleMin = function () {
        $scope.minDate = $scope.minDate ? null : new Date();
    };
    $scope.toggleMin();

    $scope.open = function ($event, which) {
        $event.preventDefault();
        $event.stopPropagation();

        $scope.datepickers[which] = true;
    };

    $scope.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };

    $scope.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    $scope.format = $scope.formats[0];

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 2);
    $scope.events =
        [
            {
                date: tomorrow,
                status: 'full'
            },
            {
                date: afterTomorrow,
                status: 'partially'
            }
        ];

    $scope.getDayClass = function (date, mode) {
        if (mode === 'day') {
            var dayToCheck = new Date(date).setHours(0, 0, 0, 0);

            for (var i = 0; i < $scope.events.length; i++) {
                var currentDay = new Date($scope.events[i].date).setHours(0, 0, 0, 0);

                if (dayToCheck === currentDay) {
                    return $scope.events[i].status;
                }
            }
        }

        return '';
    };


    $scope.addProductToCart = function ($productSkuCollection) {

        var $product = $productSkuCollection[0];

        var selectedStore = $filter('filter')(shoppingCartItems, {storeId: $product.product.product_line.store.id}, true);

        if (selectedStore.length > 0) {
            var product = {
                id: $product.id,
                product_id: $product.product.id,
                title: $product.product.title,
                image: $product.product_images[0],
                price: $product.price,
                quantity: 1,
                variants: {
                    color: $product.color,
                    size: $product.size,
                    volume: $product.volume,
                    weight: $product.weight
                }
            };
            selectedStore[0].products.push(product);
        }
        else {
            var store = {
                storeTitle: $product.product.product_line.store.name,
                storeId: $product.product.product_line.store.id
            };

            var product = {
                id: $product.id,
                product_id: $product.product.id,
                title: $product.product.title,
                image: $product.product_images[0],
                price: $product.price,
                quantity: 1,
                variants: {
                    color: $product.color,
                    size: $product.size,
                    volume: $product.volume,
                    weight: $product.weight
                }
            };

            store.products = [];
            store.products.push(product);

            shoppingCartItems.push(store);
        }

        var currentStore = $filter('filter')(shoppingCartItems, {storeId: $scope.productDetails.store.id}, true);

        $scope.isAlreadyAddedToCart = false;

        if(currentStore.length > 0)
        {
            console.log('selected store on add', selectedStore);

            angular.forEach(currentStore[0].products, function (value, key) {
                if (value.product_id == $product.product.id) {
                    $scope.isAlreadyAddedToCart = true;
                }
            });
        }

        $cookieStore.put('shoppingCartItems', shoppingCartItems);

        toastr.success('Add to Cart', 'Product added to cart successfully.');

        $rootScope.$broadcast('shoppingCartItems', {message: shoppingCartItems});
    }

    $scope.buyProduct = function ($product) {

        var currentStore = $filter('filter')(shoppingCartItems, {storeId: $product[0].product.product_line.store.id}, true);

        var isAlreadyAddedToCart = false;

        if(currentStore.length > 0)
        {
            angular.forEach(currentStore[0].products, function (value, key) {
                if (value.product_id == $product[0].product.id) {
                    isAlreadyAddedToCart = true;
                }
            });
        }

        if(!isAlreadyAddedToCart) {
            $scope.addProductToCart($product);
        }

        $location.path("/store/cart");
    };
});

