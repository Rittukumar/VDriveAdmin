
'use strict';
evezownApp
    .controller('addBrandCntr',
    function ($scope, $http, $routeParams, PATHS, usSpinnerService,Session,$cookieStore, FileUploader, ngDialog,$rootScope)
    {
        $scope.caption = true;
    $scope.imagePath = PATHS.api_url;
    $scope.location = null;
    $scope.mustHideOnWarning = false;
     $scope.mustHideOnGeneric = true;
    $scope.imageNames = [];
     $scope.currentPage = 1;
    $scope.currentUserId = $cookieStore.get('userId');
    $scope.dynamic = 0;
    $scope.isUploadingBrand = false;
     $scope.isActive = ['active', '', '', '', ''];
    $rootScope.aboutPost = "Just sharing";
    // $scope.myposts = [];
    // $scope.visibilties = [];
    $scope.loggedInUser = $cookieStore.get('userId');






       $scope.addBrand = function () {
        ngDialog.open({ template: 'templateId' });
    }; 
    var uploader = $scope.uploader = new FileUploader({
        url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
        removeAfterUpload: true,
        method: 'POST',
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

    // CALLBACKS

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
        if($scope.isUploadingBrand)
        {//alert("hh");
                        $http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') +'/brand/add'
                , { 
                    data: {
                        image_name: response.imageName,
                        title: $scope.brandname,
                        subCatId: $rootScope.currentSelectedSubCategoryId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    $scope.ReloadBrandOnAdd();
                    $scope.brandname = '';
                    $scope.isUploadingBrand = false;
                    ngDialog.close();
                    usSpinnerService.stop('spinner-1');
                    toastr.success(data.message, 'Woice');
                }).error(function (data)
                {
                    $scope.isUploadingBrand = false;
                    $scope.brandname = '';
                    usSpinnerService.stop('spinner-1');
                    toastr.error(data.error.message, 'Woice');
                });
        }
        else
        {
            $scope.imageNames.push(response.imageName);
            $scope.counter--;

            if($scope.counter == 0)
            {
                if (!$scope.woice) {
                    toastr.error("Please enter woice", 'Woice');
                }
                else if (!$scope.description) {
                    toastr.error("Please enter description", 'Woice');
                }
                else
                {
                    $scope.CreateWoice();
                }
            }
        }

    };
    uploader.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader.onCompleteItem = function(fileItem, response, status, headers)
    {

    };
    uploader.onCompleteAll = function() {
        console.info('onCompleteAll');
    };

    console.info('uploader', uploader);

    $scope.ReloadBrand = function () {

        $rootScope.currentSelectedSubCategoryId = $scope.selectedsubcategories.id;
        $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
            success(function (data) {
                $scope.brands = data.data;
                if ($scope.brands.length > 0) {
                    $scope.selectedBrand = $scope.brands[0];
                }
                usSpinnerService.stop('spinner-1');
            });
    }

    //Loading brands based on subcategoryId
    $scope.ReloadBrandOnAdd = function ()
    {
        $scope.brands  = null;
        $http.get(PATHS.api_url + 'brands/' + $rootScope.currentSelectedSubCategoryId).
            success(function (data)
            {
                $scope.$apply(function()
                {
                        $scope.brands = data.data;
                        if ($scope.brands.length > 0)
                        {
                            $scope.selectedBrand = $scope.brands[0];
                        }
                });
                usSpinnerService.stop('spinner-1');
            });

       // $scope.ReloadBrandOnAdd();
    }


    
    $scope.LoadAllData = function()
    {
        $http.get(PATHS.api_url + 'categories/1').
            success(function (data)
            {
                var notFound = true;
                $scope.categories = data.data;
                if ($scope.categories.length > 0) {
                    $scope.selectedOption = $scope.categories[0];
                    $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedOption.id).
                        success(function (data)
                        {
                            $scope.subcategories = data.data;
                            if ($scope.subcategories.length > 0)
                            {
                                angular.forEach($scope.subcategories, function (value, key)
                                {
                                    if($rootScope.selectedForum)
                                    {
                                        if(value.id == $rootScope.selectedForum.subcategory.id)
                                        {
                                            $scope.selectedsubcategories = value;
                                            notFound = false;
                                        }
                                    }
                                });

                                if(notFound)
                                {
                                    $scope.selectedsubcategories = $scope.subcategories[0];
                                }
                                $rootScope.currentSelectedSubCategoryId = $scope.selectedsubcategories.id;
                                $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
                                    success(function (data) {
                                        $scope.brands = data.data;
                                        if ($scope.brands.length > 0)
                                        {
                                            $scope.selectedBrand = $scope.brands[0];
                                        }
                                    });
                            }
                        });

                }
            });
    }

$scope.GetSubCategories = function ()
    {
        $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedOption.id).
            success(function (data)
            {
                var notFound = true;
                $scope.subcategories = data.data;
                if ($scope.subcategories.length > 0)
                {
                    angular.forEach($scope.subcategories, function (value, key)
                    {
                        if($rootScope.selectedForum)
                        {
                            if(value.id == $rootScope.selectedForum.subcategory.id)
                            {
                                $scope.selectedsubcategories = value;
                                notFound = false;
                            }
                        }
                    });

                    if(notFound)
                    {
                        $scope.selectedsubcategories = $scope.subcategories[0];
                    }

                }
            });
    }


    $scope.SaveBrand = function(files)
    {

        if(!$scope.brandname)
        {
            toastr.error('Please enter brand name', 'Woice');
        }
        else
        {   
            // alert("hh");
            $scope.isUploadingBrand = true;
            if(files.queue.length > 0)
            { 
                files.uploadAll();
            }
            else
            {
                toastr.error('Please upload a logo', 'Woice');
            }
        }
    }

$scope.LoadAllData();

});
 






