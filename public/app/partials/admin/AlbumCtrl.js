'use strict';


evezownApp.controller('albums' ,function($scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$rootScope,$routeParams,FileUploader,Lightbox,$location,ngTableParams)
{
    $scope.caption = true;
    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.allAlbums = [];
    $rootScope.selectedAlbum = "";
    $rootScope.myAlbums = [];
    $scope.albumImages = new Array();
    $scope.visibilties = [];
    $rootScope.selectedImage = "";
    $scope.imagegrade;
    $scope.albumGrade;
    $scope.isProfile = false;
    $scope.selectedVisibility = null;
    $rootScope.showVisibility = "";

$scope.albumAdminTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: $scope.albums.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.albums.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })


    if($routeParams.id != undefined)
    {
        $scope.currentUserId = $routeParams.id;
        $scope.isProfile = true;
    }
    else
    {
        $scope.currentUserId = $scope.loggedInUserId;
        $scope.isProfile = false;
    }

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
        if(!$scope.albumImages)
        {
            $scope.albumImages = new Array();
        }
        $scope.albumImages.push(response.imageName);
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
        $http.post(PATHS.api_url + 'users/albums/add_images'
            , {
                data: {
                    images: $scope.albumImages,
                    album_id: $routeParams.album_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.albumImages = new Array();
                toastr.success(data.message, 'Album');

            }).error(function (data)
            {
                $scope.albumImages = new Array();
                toastr.error(data.error.message, 'Album');

            }).then(function()
            {
                $scope.albumImages = new Array();
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            });
    };

    $scope.GetAllAlbums = function()
    {
        //users/{id}/circles
        $http.get($scope.service_url + 'users/albums/all').
            success(function (data, status, headers, config)
            {
                console.log(data.data);
                $rootScope.allAlbums = data.data;
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.GetMyAlbums = function()
    {
        //users/{id}/circles
        if($routeParams.id != undefined)
        {
            $scope.currentUserId = $routeParams.id;
        }
        else
        {
            $scope.currentUserId = $scope.loggedInUserId;
        }

        $http.get($scope.service_url + 'users/'+$scope.currentUserId+'/albums').
            success(function (data, status, headers, config)
            {
                console.log(data.data);
                $rootScope.myAlbums = data.data;
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.CreateAlbum = function()
    {
        ngDialog.open({ template: 'templateId' });
    }

    $scope.EditAlbum = function()
    {
        ngDialog.open({ template: 'EdittemplateId' });
    }

    $scope.WoiceIt = function()
    {
        ngDialog.open({ template: 'WoicetemplateId' });
    }
    //users/albums/update

    $scope.GetImageGrade = function(album_image_id)
    {
        $http.get($scope.service_url + 'users/albums/image/grade/'+album_image_id+'/get').
            success(function (data)
            {
                $scope.imagegrade = data;
            });
    }

    $scope.GetAlbumGrade = function(album_id)
    {
        $http.get($scope.service_url + 'users/albums/grade/'+album_id+'/get').
            success(function (data)
            {
                $scope.albumGrade = data;
            });
    }


    $scope.UpdateAlbumGrade = function(scale,album_id)
    {
        $http.post($scope.service_url + 'users/albums/grade/add'
            , {
                data:
                {
                    scale:scale,
                    album_id : album_id,
                    owner_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.albumGrade = data.avgGrade;
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {

                $scope.GetAlbumBasedOnId(album_id);
            });
    }

    $scope.UpdateImageGrade = function(scale,album_image_id)
    {
        $http.post($scope.service_url + 'users/albums/image/grade/add'
            , {
                data:
                {
                    scale:scale,
                    album_image_id : album_image_id,
                    owner_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.imagegrade = data.avgGrade;
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {

                $scope.GetImageGrade(album_image_id);
                $scope.GetAllAlbums();
                $scope.GetMyAlbums();
            });
    }

    $scope.UpdateAlbum = function(album)
    {
        if(!$scope.selectedAlbum.title)
        {
            toastr.error("Please enter title", 'Album');
        }
        else if(!$scope.selectedAlbum.description)
        {
            toastr.error("Please enter description", 'Album');
        }
        else
        {
            $http.post($scope.service_url + 'users/albums/update'
                , {
                    data:
                    {
                        name: album.title,
                        description:album.description,
                        album_id : album.id,
                        visibility_id: $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Albums');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Albums');
                }).then(function()
                {
                    //$scope.GetAllAlbums();
                    $scope.GetMyAlbums();
                });
        }
    }

    $scope.GetVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        $http.get(PATHS.api_url + 'visibility').
            success(function (data) {
                $scope.visibilties = data;
                if ($scope.visibilties.length > 0)
                {
                    $scope.selectedVisibility = $scope.visibilties[0];
                    $scope.GetAlbumVisibility();
                }
            });
    }

    $scope.GetAlbumVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($rootScope.selectedAlbum.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
                $rootScope.showVisibility = value;
            }
        });
    }

    $scope.SaveAlbum = function()
    {
        if(!$scope.album)
        {
            toastr.error("Please enter title", 'Album');
        }
        else if(!$scope.description)
        {
            toastr.error("Please enter description", 'Album');
        }
        else
        {
            $http.post($scope.service_url + 'users/albums/create'
                , {
                    data:
                    {
                        name: $scope.album,
                        description:$scope.description,
                        user_id:$cookieStore.get('userId'),
                        visibility_id: $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Albums');
                    $scope.Album_Id = data.id;

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Albums');
                }).then(function()
                {
                    //$scope.GetAllAlbums();
                    //$scope.GetMyAlbums();
                    var album_id = $scope.Album_Id;
                    $location.path('/albums/details/'+album_id);
                    
                });
        }
    }

    $scope.GetAlbumBasedOnId = function(albumId)
    {
        $http.get($scope.service_url + 'users/albums/'+albumId).
            success(function (data, status, headers, config)
            {
                $rootScope.selectedAlbum = data.data;
                $scope.albumGrade = $rootScope.selectedAlbum.scale;
                console.log($rootScope.selectedAlbum);

            }).error(function (data)
            {

            }).then(function()
            {
                $scope.GetVisibility();
                if ($routeParams.image_id != undefined)
                {
                    $scope.GetImageBasedOnId($routeParams.image_id);
                }
            });
    }

    $scope.DeleteAlbum = function(album)
    {
        $http.get($scope.service_url + 'users/albums/'+album.id+'/delete').
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Albums');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {
                $location.path('/albums');
                //$scope.GetAllAlbums();
                $scope.GetMyAlbums();

            });
    }

    $scope.DeleteImageFromAlbum = function(album,imageId)
    {
        var imageIds = [imageId];
        $http.post($scope.service_url + 'users/albums/remove_images'
            , {
                data:
                {
                    image_ids: imageIds,
                    album_id:album.id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            });
    }

    $scope.ShowAlbumComments = function(album,imageId)
    {
        $location.path('/albumimagecomments/'+album.id+'/'+imageId);
    }

    $scope.ShowAlbumCommentsProfile = function(album,imageId)
    {
        $location.path('/albumimagecomments/'+album.id+'/'+imageId+'/'+$scope.currentUserId);
    }

    $scope.GetImageBasedOnId = function(imageId)
    {
        angular.forEach($rootScope.selectedAlbum.images, function (value, key)
            {
                if(value.image_id == imageId)
                {
                    $scope.GetImageGrade(imageId);
                    $rootScope.selectedImage = value;
                }
            },
            $scope.imagesitems);

    }

    $scope.openLightBox = function (images, index) {
        $scope.imagesitems = [];

        angular.forEach(images, function (value, key)
            {
                $scope.imagesitems.push(value.large_image_url);
            },
            $scope.imagesitems);
        Lightbox.baseURI = '';
        Lightbox.openModal($scope.imagesitems, index);
    }

    //alert($routeParams.album_id);

    $scope.CreateComment = function (image)
    {
        $http.post($scope.service_url + 'users/albums/image/comment/add'
            , {
                data:
                {
                    comment: $scope.addedcomment,
                    album_image_id:image.image_id,
                    commeter_id:$cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {
                $scope.addedcomment = "";
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            });
    }


    $scope.DeleteAlbumComment = function (comment)
    {
        $http.post($scope.service_url + 'users/albums/image/comment/remove'
            , {
                data:
                {
                    comment_id: comment.comment_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            });
    }

    $scope.CreateAlbumComment = function (album)
    {
        $http.post($scope.service_url + 'users/albums/comment/add'
            , {
                data:
                {
                    comment: $scope.addedcomment,
                    album_id:album.id,
                    commeter_id:$cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {
                $scope.addedcomment = "";
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            });
    }

    $scope.DeleteClick = function(comment)
    {
        $http.post($scope.service_url + 'users/albums/image/comment/delete'
            , {
                data:
                {
                    comment_id: comment.comment_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Albums');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Albums');
            }).then(function()
            {
                $scope.GetAlbumBasedOnId($routeParams.album_id);
            });
    }

    $scope.CreateWoice = function (album)
    {
        var postImages = [];
        angular.forEach(album.images, function (value, key)
            {
                postImages.push(value.large_image_url);
            },
            $scope.imagesitems);
        if($scope.WoiceTitle == undefined)
        {
            toastr.error("Please enter title", 'Album');
        }
        else
        {
            $http.post(PATHS.api_url + 'users/' + $cookieStore.get('userId') + '/post/create'
                , {
                    data: {
                        title: $scope.WoiceTitle,
                        owner_id: $cookieStore.get('userId'),
                        description: $scope.Woicedescription,
                        testimonial: album.description,
                        visibility_id: 1,
                        post_type_id: 1,
                        url_link: '#albums/details/'+album.id,
                        images: postImages
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Album');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Album');
                });
        }

    }

    //$scope.$watch('imagegrade', function(newvalue,oldvalue)
    //{
    //    $scope.imagegrade =   newvalue;
    //});


    if($routeParams.album_id != undefined )
    {
        $scope.GetAlbumBasedOnId($routeParams.album_id);
    }
    else
    {
        $scope.GetVisibility();
        $scope.GetMyAlbums();
     //   $scope.GetAllAlbums();
    }
});
