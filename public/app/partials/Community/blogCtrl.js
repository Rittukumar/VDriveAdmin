'use strict';


evezownApp.controller('blogCntrl' ,function($scope, PATHS,$cookieStore,$http,$rootScope,$location,$routeParams,ImageService,FileUploader,ngDialog)
{
    $scope.caption = true;
    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.allBlogs = [];
    $rootScope.myBlogs  = [];
    $rootScope.selectedBlog = "";
    $scope.visibilties = [];
    $scope.blogGrade;
    $scope.isProfile = false;
    $scope.selectedVisibility = null;
    $rootScope.showVisibility = "";
    $scope.isActive = ['', 'active', '', ''];
    
    //breadcrumb link
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
    //Loading subcategories based on categoryId
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
                        if(value.id == $rootScope.selectedBlog.subcategory.id)
                        {

                            $scope.selectedsubcategories = value;
                            notFound = false;
                        }
                    });

                    angular.forEach($scope.categories, function (value1, key1)
                    {
                        //alert(value1.id);
                        if(value1.id == $rootScope.selectedBlog.selectedsubcategories.category.id)
                        {

                            //alert(value1);
                            $scope.selectedOption = value1;
                            notFound = false;
                        }
                    });

                    if(notFound)
                    {
                        $scope.selectedsubcategories = $scope.subcategories[0];
                    }

                }
            });
    }

    $scope.$watch('selectedsubcategories', function(newvalue,oldvalue)
    {
        $scope.selectedsubcategories = newvalue;
    });

    $scope.$watch('selectedCategory', function(newvalue,oldvalue)
    {
        $scope.selectedOption = newvalue;
    });

    $scope.GetVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        $http.get(PATHS.api_url + 'visibility').
            success(function (data) {
                $scope.visibilties = data;
                if ($scope.visibilties.length > 0)
                {
                    $scope.selectedVisibility = $scope.visibilties[0];
                    $scope.GetBlogVisibility();
                }
            });
    }

    $scope.GetBlogVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($rootScope.selectedBlog.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
                $rootScope.showVisibility = value;
            }
        });
    }

    //Loading brands based on subcategoryId
    $scope.ReloadBrand = function ()
    {
        $rootScope.currentSelectedSubCategoryId = $scope.selectedsubcategories.id;
        $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
            success(function (data)
            {
                var notFound = true;
                $scope.brands = data.data;
                if ($scope.brands.length > 0) {
                    angular.forEach($scope.brands, function (value, key)
                    {
                        if(value.id == $rootScope.selectedBlog.subcategory.id)
                        {
                            $scope.selectedBrand = value;
                            notFound = false;
                        }
                    });

                    if(notFound)
                    {
                        $scope.selectedBrand = $scope.brands[0];
                    }
                }
            });
    }

    $scope.LoadAllData = function()
    {
        $http.get(PATHS.api_url + 'categories/1').
            success(function (data)
            {
                var notFound = true;
                $scope.categories = data.data;

                if ($scope.categories.length > 0)
                {
                    if(!$routeParams.blog_id)
                    {
                        $scope.selectedOption = $scope.categories[5];
                    }
                    $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedOption.id).
                        success(function (data)
                        {
                            $scope.subcategories = data.data;
                            if ($scope.subcategories.length > 0)
                            {

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

    $scope.SaveBlog = function(isPublished)
    {
        if($scope.title == undefined || $scope.title == "")
        {
            toastr.error("Please enter title", 'Blog');
        }
        else if($scope.htmlVariable == undefined || $scope.htmlVariable == "")
        {
            toastr.error("Please enter Blog Content", 'Blog');
        }
        else if($scope.selectedOption.category_name == "Not Specified")
        {
            toastr.error("Please select category", 'Blog');
        }
        else if($scope.selectedsubcategories == undefined)
        {
            toastr.error("Please select sub category", 'Blog');
        }
        else
        {
            $http.post($scope.service_url + 'users/blogs/create'
                , {
                    data:
                    {
                        title: $scope.title,
                        author_id:$cookieStore.get('userId'),
                        sub_cat_id:$rootScope.currentSelectedSubCategoryId,
                        content:$scope.htmlVariable,
                        visibility_id: $scope.selectedVisibility.id


                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    console.log(data);
                    //toastr.success(data.message, 'Blog');
                    $scope.Blog_Id = data.id;

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Blog');

                }).then(function(data)
                {
                    if(isPublished)
                    {
                        console.log(data.data);
                        $http.post($scope.service_url + 'users/blogs/'+data.data.id+'/publish'
                            , {
                                headers: {'Content-Type': 'application/json'}
                            }).
                            success(function (data, status, headers, config)
                            {
                                //toastr.success(data.message, 'Blog');
                                toastr.success('Blog created and published successfully');

                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Blog');

                            }).then(function()
                            {
                                $location.path('/blogs/'+$scope.Blog_Id);
                            });
                    }
                    else
                    {
                        $location.path('/blogs/'+$scope.Blog_Id);
                    }
                });
        }
    }

    $scope.EditBlogById = function(isPublished)
    {
        if($scope.title == '')
        {
            toastr.success("Please enter title", 'Blog');
        }
        else
        {
            $http.post($scope.service_url + 'users/blogs/update'
                , {
                    data:
                    {
                        title: $scope.selectedBlog.title,
                        sub_cat_id:$rootScope.currentSelectedSubCategoryId,
                        content:$scope.htmlVariable,
                        blog_id:$rootScope.selectedBlog.id,
                        visibility_id: $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    console.log(data);
                    toastr.success(data.message, 'Blog');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Blog');

                }).then(function(data)
                {
                    if(isPublished)
                    {
                        console.log(data.data);
                        $http.post($scope.service_url + 'users/blogs/'+data.data.id+'/publish'
                            , {
                                headers: {'Content-Type': 'application/json'}
                            }).
                            success(function (data, status, headers, config)
                            {
                                toastr.success(data.message, 'Blog');

                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Blog');

                            }).then(function()
                            {
                                $location.path('/blogs');
                            });
                    }
                    else
                    {
                        $location.path('/blogs');
                    }
                });
        }
    }

    $scope.AddBlogComment = function(selectedBlog,addedcomment)
    {
        if(!$scope.addedcomment)
        {
            toastr.success("Please enter a comment", 'Blog');
        }
        else
        {
            $http.post($scope.service_url + 'users/blogs/comment/add'
                , {
                    data:
                    {
                        user_id:$cookieStore.get('userId'),
                        blog_id:selectedBlog.id,
                        comment:addedcomment

                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    toastr.success(data.message, 'Blog');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Blog');

                }).then(function()
                {
                    $scope.addedcomment = "";
                    $scope.GetAllBlogs();
                });
        }

    }


    //users/blogs/{blog_id}/delete

    $scope.DeleteBlog = function(blog)
    {
        $http.get(PATHS.api_url + 'users/blogs/'+blog.id+'/delete').
            success(function (data)
            {
                toastr.success(data.message, 'Blogs');
                $location.path('/blogs');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Blogs');
            });
    }

    $scope.GetAllBlogs = function()
    {
        $http.get(PATHS.api_url + 'users/blogs/published').
            success(function (data)
            {
                //alert(PATHS.api_url + 'users/blogs/published');
                $rootScope.allBlogs = data.data;
                $scope.GetBlogById($routeParams.blog_id);
            });
    }

    $scope.GetMyBlogs = function()
    {
        if($routeParams.id != undefined)
        {
            $scope.currentUserId = $routeParams.id;
        }
        else
        {
            $scope.currentUserId = $scope.loggedInUserId;
        }

        $http.get(PATHS.api_url + 'users/'+$scope.currentUserId+'/blogs').
            success(function (data)
            {
                $rootScope.myBlogs = data.data;
                $scope.GetBlogById($routeParams.blog_id);
            });
    }

    $scope.GetBlogGrade = function(blog_id)
    {
        $http.get($scope.service_url + 'users/blogs/grade/'+blog_id+'/get').
            success(function (data)
            {
                $scope.blogGrade = data;
            });
    }


    $scope.WoiceIt = function()
    {
        ngDialog.open({ template: 'WoicetemplateId' });
    }

    $scope.CreateWoice = function (blog)
    {
        var postImages = [];
        if($scope.WoiceTitle == undefined)
        {
            toastr.error("Please enter title", 'Blog');
        }
        else
        {
            $http.post(PATHS.api_url + 'users/' + $cookieStore.get('userId') + '/post/create'
                , {
                    data: {
                        title: $scope.WoiceTitle,
                        owner_id: $cookieStore.get('userId'),
                        description: $scope.Woicedescription,
                        testimonial: blog.title,
                        visibility_id: 1,
                        post_type_id: 1,
                        url_link: '#blogs/'+blog.id,
                        images: postImages
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Blogs');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Blogs');
                });
        }

    }


    $scope.GetCategoryById = function(catId)
    {
        $http.get($scope.service_url + 'category/'+catId+'/get').
            success(function (data)
            {
                $scope.selectedOption = data;
            });
    }

    $scope.GetSubCategoryById = function(subCatId)
    {
        $http.get($scope.service_url + 'subcategory/'+subCatId+'/get').
            success(function (data)
            {
                $scope.selectedsubcategories = data;
            });
    }

    $scope.UpdateBlogGrade = function(scale,blog_id)
    {
        $http.post($scope.service_url + 'users/blogs/grade/add'
            , {
                data:
                {
                    scale:scale,
                    blog_id : blog_id,
                    owner_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.blogGrade = data.avgGrade;
                toastr.success(data.message, 'Blogs');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Blogs');
            }).then(function()
            {

                $scope.GetBlogById(blog_id);
            });
    }

    $scope.GetBlogById = function(blogId)
    {
        $http.get(PATHS.api_url + 'users/blogs/'+blogId).
            success(function (data)
            {
                $rootScope.selectedBlog = data.data;
                $scope.htmlVariable = $scope.selectedBlog.content;
                $scope.title = $scope.selectedBlog.title;
                $scope.blogGrade = $scope.selectedBlog.scale;
                //$scope.selectedOption = $scope.selectedBlog.subcategory.category;
                $scope.GetSubCategories();
                $scope.GetVisibility();
            }).error(function(data)
            {

            }).then(function(data)
            {
                $scope.GetCategoryById($scope.selectedBlog.subcategory.id);
                $scope.GetSubCategoryById($scope.selectedBlog.subcategory.category.id);
            });
    }

    $scope.convertToDate = function (stringDate){
        var dateOut = new Date(stringDate);
        dateOut.setDate(dateOut.getDate());
        return dateOut;
    };


    $scope.DeleteComment = function(commentId)
    {
        $http.post($scope.service_url + 'users/blogs/comment/delete'
            , {
                data:
                {
                    comment_id:commentId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Blog');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Blog');

            }).then(function()
            {
                $scope.GetAllBlogs();
            });
    }

    $scope.EditBlog = function(blog)
    {
        $location.path('/editblog/'+blog.id);
    }
    $scope.EditMyBlog = function(blog)
    {
        $location.path('/editmyblog/'+blog.id);
    }

//editmyblog


    var uploader1 = $scope.uploader1 = new FileUploader({
        url: PATHS.api_url + 'image/upload', // upload.php script, node.js route, or servlet url
        removeAfterUpload: true,
        method: 'POST',
        autoUpload:true,
        alias: 'image'
    });





    uploader1.filters.push({
        name: 'imageFilter',
        fn: function (item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
    });

    // CALLBACKS





    uploader1.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        console.info('onWhenAddingFileFailed', item, filter, options);
    };
    uploader1.onAfterAddingFile = function(fileItem) {
        console.info('onAfterAddingFile', fileItem);
    };
    uploader1.onAfterAddingAll = function(addedFileItems)
    {
        $scope.counter = addedFileItems.length;
        console.info('onAfterAddingAll', addedFileItems);
    };
    uploader1.onBeforeUploadItem = function(item) {
        console.info('onBeforeUploadItem', item);
    };
    uploader1.onProgressItem = function(fileItem, progress) {
        console.info('onProgressItem', fileItem, progress);
    };
    uploader1.onProgressAll = function(progress) {
        console.info('onProgressAll', progress);
    };
    uploader1.onSuccessItem = function(fileItem, response, status, headers)
    {
        $http.post(PATHS.api_url + 'users/blogs/image/update'
            , {
                data: {
                    image_name: response.imageName,
                    blog_id: $routeParams.blog_id
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                ImageService.getImage(PATHS.api_url + 'users/blogs/' + $routeParams.blog_id + '/cover_image/current').success(function(data){
                    $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
                });
                toastr.success(data.message, 'Blogs');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Blogs');
            });
    };
    uploader1.onErrorItem = function(fileItem, response, status, headers) {
        console.info('onErrorItem', fileItem, response, status, headers);
    };
    uploader1.onCancelItem = function(fileItem, response, status, headers) {
        console.info('onCancelItem', fileItem, response, status, headers);
    };
    uploader1.onCompleteItem = function(fileItem, response, status, headers)
    {

    };
    uploader1.onCompleteAll = function()
    {
    };





    ImageService.getImage(PATHS.api_url + 'users/blogs/' + $routeParams.blog_id + '/cover_image/current').success(function(data){
        
        if(data == "NoCoverImage")
        {
            $rootScope.coverImage = null;
        }
        else
        {
            $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
        }
    });
    $scope.GetVisibility();
    //$scope.GetAllBlogs();

    if(!$routeParams.blog_id)
    {
        $scope.GetMyBlogs();
        $scope.LoadAllData();
    }
    else
    {
        $scope.GetBlogById($routeParams.blog_id);
    }

});

/*Blog Cover Image crop*/
evezownApp
    .controller('BlogCoverImageCrop', function ($scope, AuthService, ngDialog, $location, $controller, $http, $cookieStore, PATHS, FileUploader, $rootScope, $routeParams) {


    $scope.ChangeBlogCover = function () {

    var cropTitleImageDialog = ngDialog.open(
        {
            template: 'BlogCover',
            scope: $scope,
            className: 'ngdialog-theme-plain',
            controller: $controller('BlogCoverCropCtrl', {
                $scope: $scope
            })
        });
    }
});

evezownApp.controller('BlogCoverCropCtrl', function ($scope, StoreService,$http, PATHS,ImageService,
                                                      usSpinnerService, ngDialog, $routeParams, $rootScope) {
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

    $scope.ChangeBlogCoverImage = function () {
        
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
                $http.post(PATHS.api_url + 'users/blogs/image/update'
                , {
                    data: {
                        image_name: data.imageName,
                        blog_id: $routeParams.blog_id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config) {
                    $rootScope.coverImage = "";
                    ImageService.getImage(PATHS.api_url + 'users/blogs/' + $routeParams.blog_id + '/cover_image/current').success(function(data){
                    $rootScope.coverImage = PATHS.api_url +'image/show/'+data;
                    toastr.success("Blog Cover Updated");
                    ngDialog.close("", data);
                    });
                    });
                    
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

//Filter to limit the caracters
evezownApp.filter('strLimit', ['$filter', function($filter)
{
   return function(input, limit) {
     if (! input) return;
     if (input.length <= limit) {
          return input;
      }
    
      return $filter('limitTo')(input, limit) + '...';
   };
}]);
