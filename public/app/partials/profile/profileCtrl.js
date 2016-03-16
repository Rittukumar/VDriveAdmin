evezownApp
// inject the invite service into our controller
    .controller('profileCtrl', function ($scope, AuthService, ngDialog, profileService,
                                         $http, PATHS, FileUploader, $routeParams, $cookieStore,
                                         ImageService, $rootScope, $location) {

        $scope.loggedInUserId = $cookieStore.get('userId');
        $scope.currentUserId = $routeParams.id;
        $scope.carouselTitle = "Evezown";
        if ($routeParams.id != undefined) {
            $scope.currentUserId = $routeParams.id;
        }
        else {
            $scope.currentUserId = $scope.loggedInUserId;
        }

        if ($location.path() == '/profile/'+ $scope.currentUserId) {
            $scope.isActive = ['active', '', '', ''];
        }
        else
        {
            $scope.isActive = ['', 'active', '', ''];
        }
        //$scope.imageTag = 0;
        //$scope.rightCoverImage = null;
        //$scope.leftCoverImage = null;
        //$scope.bottomCoverImage = null;


        function fetchProfile(userID) {
            profileService.getProfile(userID).then(function (data) {
                $scope.firstname = data.firstname;
                $scope.lastname = data.lastname;
                $scope.aboutme = data.aboutme;
                $scope.userId = data.id;
                $scope.role = data.role;
                $scope.Profession = data.profession;
                $scope.designation = data.designation;
                $scope.organization = data.organization;
                $scope.connectingtext = "At";
                $scope.state = data.state;
                $scope.city = data.city;
                $scope.country = data.country;
                $scope.email = data.email;
                //state and country
                if ($scope.city != "" && $scope.country != "") {
                    $scope.locationDetails = $scope.city + ', ' + $scope.country;
                }
                else if ($scope.city == "" && $scope.country) {
                    $scope.locationDetails = $scope.country;
                }
                else {
                    $scope.locationDetails = $scope.city;
                }
                $scope.currentProfileImage = "";
                $scope.loggedInUserId = $cookieStore.get('userId');
                var myDataPromise = AuthService.setImage(PATHS.api_url + 'users/' + userID + '/profile_image/current');
                myDataPromise.then(function (result) {  // this is only run after $http completes
                    //$rootScope.profileImage = AuthService.getImage();
                    $scope.currentProfileImage = AuthService.getImage();
                });
            });
        }

        function getStoresByOwnerId() {
            $http.get(PATHS.api_url + 'stores/owner/' + $scope.currentUserId + '/get').
                success(function (data) {
                    $scope.browseMyItems = data;
                }).then(function () {

                });
        }

        getStoresByOwnerId();

        //function fetchProfileImage(userId)
        //{
        //    var imagePath = PATHS.api_url + 'users/' + userId + '/profile_image/current';
        //    $http.get(imagePath).
        //        success(function (data, status, headers, config)
        //        {
        //            $scope.profileImage = PATHS.api_url +'image/show/'+data;
        //            $rootScope.$broadcast('profileImage', data);
        //        })
        //        .error(function (data)
        //        {
        //            console.log(data);
        //        });
        //}

        function fetchRightCoverImage(userId) {
            var imagePath = PATHS.api_url + 'users/' + userId + '/right_image/current';
            $http.get(imagePath).
                success(function (data, status, headers, config) {
                    if(data)
                    {
                        $scope.rightCoverImage = PATHS.api_url + 'image/show/' + data + '/803/452';
                    }
                })
                .error(function (data) {
                    console.log(data);
                });
        }

        function fetchLeftCoverImage(userId) {
            var imagePath = PATHS.api_url + 'users/' + userId + '/left_image/current';
            $http.get(imagePath).
                success(function (data, status, headers, config) {
                    if(data) {
                        $scope.leftCoverImage = PATHS.api_url + 'image/show/' + data + '/392/220';
                    }
                })
                .error(function (data) {
                    console.log(data);
                });
        }

        function fetchBottomCoverImage(userId) {
            var imagePath = PATHS.api_url + 'users/' + userId + '/bottom_image/current';
            $http.get(imagePath).
                success(function (data, status, headers, config) {
                    if(data) {
                        $scope.bottomCoverImage = PATHS.api_url + 'image/show/' + data + '/393/220';
                    }
                })
                .error(function (data) {
                    console.log(data);
                });
        }

        // Cropper code start

        $scope.openLeftCoverPicChange = function () {
            ngDialog.open({template: 'leftProfilePicUploadTemplateId'});
        }

        $scope.showControls = true;
        $scope.imageResult = null;

        $scope.onFileSelect = function($files) {
            var file = $files[0];
            var reader = new FileReader();
            reader.onload = function (evt) {
                //self.imageAdjust(evt.target.result,file);
                $scope.image = evt.target.result;
            };
            if($files.length > 0)
                reader.readAsDataURL(file);
        };

        // Cropper code end


        //take a tour starts
        $scope.IntroOptions = {
                steps:[
                    {
                        element: '#step1',
                        intro: "Your personal info here, like name, email, ect"
                    },
                    {
                        element: '#step2',
                        intro: "Enhance your profile by adding hobbies,achievements, ect",
                    },
                    {
                        element: '#step3',
                        intro: 'Your online presence. You can add your social network sites here',
                        position: 'bottom'
                    },
                    {
                        element: '#step4',
                        intro: "Enter your favorite topics, Area of interest",
                        position: 'bottom'
                    },
                    {
                        element: '#step5',
                        intro: 'You can refer your friends to join evezown'
                    },
                    {
                        element: '#step6',
                        intro: 'Your participation in evezown like stores,ecommerce, ect'
                    },
                    {
                        element: '#step7',
                        intro: 'Other evezown services such as careers, joblistings, ect'
                    },
                    {
                        element: '#step8',
                        intro: 'Partnering with evezown through blogs,discussions ect'
                    },
                    {
                        element: '#step9',
                        intro: 'Your Feedback/suggestions for further improvements'
                    }
                ],
                showStepNumbers: false,
                exitOnOverlayClick: true,
                exitOnEsc:true,
                nextLabel: '<strong>NEXT!</strong>',
                prevLabel: '<span style="color:green">Previous</span>',
                skipLabel: 'Exit',
                doneLabel: 'Thanks'
            };

            $scope.ShouldAutoStart = false;
        //take a tour ends


        ////users/{id}/profile_image/all
        //function fetchAllProfileImage(userId)
        //{
        //    var imagePath = PATHS.api_url + 'users/' + userId + '/profile_image/all';
        //    $http.get(imagePath).
        //        success(function (data, status, headers, config)
        //        {
        //           // $scope.profileImage = PATHS.api_url +'image/show/'+data;
        //            console.log(data.data);
        //        })
        //        .error(function (data)
        //        {
        //            console.log(data);
        //        });
        //}

        $scope.UploadProfileImage = function (files) {
            $scope.imageTag = 0;
            files.uploader.uploadAll();
        }

        $scope.UploadCoverImage1 = function (files) {
            //alert('test');
            $scope.imageTag = 1;
            files.uploader.uploadAll();
        }
        $scope.UploadCoverImage2 = function (files) {
            $scope.imageTag = 2;
            files.uploader.uploadAll();
        }
        $scope.UploadCoverImage3 = function (files) {
            $scope.imageTag = 3;
            files.uploader.uploadAll();
        }

        var uploader = $scope.uploader = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });

        uploader.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS


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
            $http.post(PATHS.api_url + 'users/profile_image/update'
                , {
                    data: {
                        image_name: response.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    var myDataPromise = AuthService.setImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/profile_image/current');
                    myDataPromise.then(function (result) {  // this is only run after $http completes
                        $rootScope.profileImage = AuthService.getImage();
                    });
                    toastr.success(data.message, 'Profile');
                }).error(function (data) {
                    toastr.error(data.error.message, 'Profile');
                });
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
            console.info('onCompleteAll');
        };

        var uploader1 = $scope.uploader1 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });


        $scope.$watch('profileImage', function (newvalue, oldvalue) {
            if (oldvalue) {
                if (oldvalue != newvalue) {
                    $rootScope.profileImage = newvalue;
                }
            }
        });


        uploader1.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS


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
            $http.post(PATHS.api_url + 'users/left_cover_image/update'
                , {
                    data: {
                        image_name: response.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/left_image/current').success(function (data) {
                        $scope.leftCoverImage = PATHS.api_url + 'image/show/' + data;
                    });
                    toastr.success(data.message, 'Woice');
                }).error(function (data) {
                    toastr.error(data.error.message, 'Woice');
                });
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
            console.info('onCompleteAll');
        };

        var uploader2 = $scope.uploader2 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });


        uploader2.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS


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
            $http.post(PATHS.api_url + 'users/bottom_cover_image/update'
                , {
                    data: {
                        image_name: response.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/bottom_image/current').success(function (data) {
                        $scope.bottomCoverImage = PATHS.api_url + 'image/show/' + data;
                    });
                    toastr.success(data.message, 'Woice');
                }).error(function (data) {
                    toastr.error(data.error.message, 'Woice');
                });
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
            console.info('onCompleteAll');
        };

        var uploader3 = $scope.uploader3 = new FileUploader({
            url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
            removeAfterUpload: true,
            method: 'POST',
            autoUpload: true,
            alias: 'image'
        });


        uploader3.filters.push({
            name: 'imageFilter',
            fn: function (item /*{File|FileLikeObject}*/, options) {
                var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
                return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
            }
        });

        // CALLBACKS


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
            $http.post(PATHS.api_url + 'users/right_cover_image/update'
                , {
                    data: {
                        image_name: response.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/right_image/current').success(function (data) {
                        $scope.rightCoverImage = PATHS.api_url + 'image/show/' + data + '/803/452';
                    });
                    toastr.success(data.message, 'Profile');
                }).error(function (data) {
                    toastr.error(data.error.message, 'Profile');
                });
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
            console.info('onCompleteAll');
        };

        fetchProfile($scope.currentUserId);
        //AuthService.getProfileImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/profile_image/current').success(function(data) {
        //    $scope.profileImage = PATHS.api_url + 'image/show/' + data;
        //});


        ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId +
            '/right_image/current').success(function (data) {
            if(data)
            {
                $scope.rightCoverImage = PATHS.api_url + 'image/show/' + data + '/803/452';
            }
        });
        ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId +
            '/left_image/current').success(function (data) {
            if(data) {
                $scope.leftCoverImage = PATHS.api_url + 'image/show/' + data + '/392/220';
            }
        });
        //fetchBottomCoverImage($scope.currentUserId);

        ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId +
            '/bottom_image/current').success(function (data) {
            if(data) {
                $scope.bottomCoverImage = PATHS.api_url + 'image/show/' + data + '/392/220';
            }
        });
    });

/*Profile picture crop*/
evezownApp
    .controller('ProfileImageCrop', function ($scope, AuthService, ngDialog, $location, $controller, $http, $cookieStore, PATHS, FileUploader, $rootScope, $routeParams) {

        if ($routeParams.id != undefined) {
            $scope.profileImage = "";
            $scope.currentUserId = $routeParams.id;
            AuthService.getProfileImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/profile_image/current').success(function(data) {
            $scope.profileImage = PATHS.api_url + 'image/show/' + data +'/250/250';
            });
        }
        else {
            $scope.currentUserId = $scope.loggedInUserId;
        }

//left cover
$scope.CropProfileLeft = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'CropLeftImage',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('LeftCoverCtrl', {
                $scope: $scope
            })
        });

    /*cropTitleImageDialog.closePromise.then(function (data) {
        console.log('Crop Slide Image Response: ' + data);

        if (data.value.status) {
            $scope.addStores.slideImage = {};
            $scope.addStores.slideImage.croppedImage = data.value.imageName;
        }

    });*/
}

//Bottom Cover
$scope.CropProfileBottom = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'CropBottomImage',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('BottomCoverCtrl', {
                $scope: $scope
            })
        });

   /* cropTitleImageDialog.closePromise.then(function (data) {
        console.log('Crop Slide Image Response: ' + data);

        if (data.value.status) {
            $scope.addStores.slideImage = {};
            $scope.addStores.slideImage.croppedImage = data.value.imageName;
        }

    });*/
}

//Right Cover
$scope.CropProfileRight = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'CropRightImage',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('RightCoverCtrl', {
                $scope: $scope
            })
        });

    /*cropTitleImageDialog.closePromise.then(function (data) {
        console.log('Crop Slide Image Response: ' + data);

        if (data.value.status) {
            $scope.addStores.slideImage = {};
            $scope.addStores.slideImage.croppedImage = data.value.imageName;
        }

    });*/
}

//Profile Cover image
$scope.CropEvezsiteImage = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'EvezsiteImage',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('EvezsiteImageCtrl', {
                $scope: $scope
            })
        });

    /*cropTitleImageDialog.closePromise.then(function (data) {
        console.log('Crop Slide Image Response: ' + data);

        if (data.value.status) {
            $scope.addStores.slideImage = {};
            $scope.addStores.slideImage.croppedImage = data.value.imageName;
        }

    });*/
}

});

evezownApp.controller('LeftCoverCtrl', function ($scope, StoreService,$http, PATHS,ImageService,
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

    $scope.slideImage.aspectRatio = 800 / 350;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 800 / 350;

    $scope.LeftCoverImage = function () {
        usSpinnerService.spin('spinner-1');
        StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                $http.post(PATHS.api_url + 'users/left_cover_image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/left_image/current').success(function (data) {
                    $scope.leftCoverImage = PATHS.api_url + 'image/show/' + data;
                    toastr.success("Left Cover Updated");
                    ngDialog.close("", data);
                    });
                    });
                    
            });
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('BottomCoverCtrl', function ($scope, StoreService,$http, PATHS,ImageService,
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

    $scope.slideImage.aspectRatio = 383 / 220;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 800 / 350;

    $scope.BottomCoverImage = function () {
        usSpinnerService.spin('spinner-1');
        StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                $http.post(PATHS.api_url + 'users/bottom_cover_image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/bottom_image/current').success(function (data) {
                    $scope.bottomCoverImage = PATHS.api_url + 'image/show/' + data;
                    toastr.success("Bottom Cover Updated");
                    ngDialog.close("", data);
                    });
                    });         
            });
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }

});

evezownApp.controller('RightCoverCtrl', function ($scope, StoreService,$http, PATHS,ImageService,
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

    $scope.slideImage.aspectRatio = 1200 / 700;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 1200 / 700;

    $scope.RightCoverImage = function () {
        usSpinnerService.spin('spinner-1');
        StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                $http.post(PATHS.api_url + 'users/right_cover_image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    ImageService.getImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/right_image/current').success(function (data) {
                    $scope.rightCoverImage = PATHS.api_url + 'image/show/' + data + '/803/452';
                    toastr.success("Right Cover Updated");
                    ngDialog.close("", data);
                    });
                    });  
            });
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }
});

evezownApp.controller('EvezsiteImageCtrl', function ($scope, AuthService, StoreService,$http, PATHS,ImageService,
        usSpinnerService, ngDialog,profileService,$routeParams, $cookieStore,$rootScope) {
    $scope.slideImage = {};
    // Must be [x, y, x2, y2, w, h]
    $scope.slideImage.coords = [100, 100, 200, 200, 100, 100];

    $scope.slideImage.selected = function (coords) {
        console.log("selected", coords);
        $scope.slideImage.coords = coords;
    };

    // You can add a thumbnail if you want
    $scope.slideImage.thumbnail = false;

    $scope.slideImage.aspectRatio = 400 / 300;

    $scope.slideImage.boxWidth = 350;

    $scope.slideImage.cropConfig = {};

    $scope.slideImage.cropConfig.aspectRatio = 400 / 300;

    $scope.UpdateEvezsiteImage = function () {
        usSpinnerService.spin('spinner-1');
        StoreService.uploadSlideImage(
            getBase64Image($scope.slideImage.src),
            $scope.slideImage.coords)
            .then(function (data) {
                $http.post(PATHS.api_url + 'users/profile_image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        user_id: $scope.loggedInUserId
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    var myDataPromise = AuthService.setImage(PATHS.api_url + 'users/' + $scope.currentUserId + '/profile_image/current');
                    myDataPromise.then(function (result) {  // this is only run after $http completes
                    $rootScope.profileImage = AuthService.getImage();
                    $scope.profileImage = AuthService.getImage();
                    toastr.success("Profile Picture Updated");
                    ngDialog.close("", data);
                    });
                    });
            });
    }

    function getBase64Image(dataURL) {
        // imgElem must be on the same server otherwise a cross-origin error will be
        //  thrown "SECURITY_ERR: DOM Exception 18"
        return dataURL.replace(/^data:image\/(png|jpg|jpeg);base64,/, "");
    }
});
/*Profile picture crop ends*/


evezownApp.factory('ImageService', function ($http) {
    var image = null;
    return {
        getImage: function (imagePath) {
            return $http({
                url: imagePath,
                method: 'GET'
            })
        }
    }
})
evezownApp.directive('duoStars', function () {
    return {
        scope: {
            "ngModel": "=",
            "max": "="
        },
        restrict: "EA",
        template: '<span ng-repeat="star in stars" ng-class="{\'active\':$index<ngModel}" ng-click="setVal(star)"><i class="fa fa-square"></i></span>',
        require: "ngModel",
        link: function (scope, elem, attr) {
            if (attr.value) {
                scope.ngModel = attr.value;
            }
            if ((attr.readonly != null)) {
                return scope.readonly = true;
            }
        },
        controller: function ($scope) {
            var _i, _ref, _results;
            $scope.stars = (function () {
                _results = [];
                for (var _i = 1, _ref = $scope.max; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                    _results.push(_i);
                }
                return _results;
            }).apply(this);
            return $scope.setVal = function (index) {
                if ($scope.readonly) {
                    return;
                }
                if (($scope.ngModel === index && index === 1)) {
                    return $scope.ngModel = 0;
                } else {
                    return $scope.ngModel = index;
                }
            };
        }
    };
});