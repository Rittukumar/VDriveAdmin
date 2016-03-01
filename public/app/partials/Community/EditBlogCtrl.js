'use strict';


evezownApp.controller('EditBlogCtrl' ,function($scope, PATHS,$cookieStore,$http,$rootScope,$location,$routeParams,ImageService,FileUploader)
{
    $scope.caption = true;
    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.allBlogs = [];
    $rootScope.myBlogs  = [];
    $rootScope.selectedBlog = "";
    $scope.visibilties = [];
    $scope.blogGrade;
    $scope.categories = [];
    $scope.subcategories = [];
    $scope.selectedOption = null;
    $scope.selectedCategory = "";
    $scope.category1 = null;
    $scope.selectedsubcategories = null;
    $scope.selectedVisibility = null;

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
        $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedCategory.id).
            success(function (data)
            {
                $scope.subcategories = data.data;
                if ($scope.subcategories.length > 0)
                {
                    $scope.selectedSubCategory = $scope.subcategories[0];
                }

            }).then(function(data)
            {
                $scope.GetSubCategoryById();
            });
    }


    $scope.GetCategories = function ()
    {
        $http.get(PATHS.api_url + 'categories/1').
            success(function (data)
            {
                $scope.categories = data.data;
            }).then(function(data)
            {
                $scope.GetCategoryById();
                $scope.GetSubCategories();
            });
    }

    $scope.GetCategoryById = function()
    {
        angular.forEach($scope.categories, function (value, key)
        {
            if($scope.selectedBlog.subcategory.category.id == value.id)
            {
                $scope.selectedCategory = value;
            }
        });
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
                    $scope.GetBlogVisibility();
                }
            });
    }

    $scope.GetBlogVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($scope.selectedBlog.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
            }
        });
    }


    $scope.SaveBlog = function(isPublished)
    {
        if($scope.title == '')
        {
            toastr.success("Please enter title", 'Blog');
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
                                $location.path('/myblogs/' + $scope.loggedInUserId);
                            });
                    }
                    else
                    {
                        $location.path('/myblogs/' + $scope.loggedInUserId);
                    }
                });
        }
    }

    $scope.EditBlogById = function(isPublished)
    {
        if($scope.selectedBlog.title == "")
        {
            toastr.error("Please enter title", 'Blog');
        }
        else if($scope.htmlVariable == "")
        {
            toastr.error("Please enter Blog Content", 'Blog');
        }
        else if($scope.selectedCategory.category_name == "Not Specified")
        {
            toastr.error("Please select category", 'Blog');
        }
        else
        {
            $http.post($scope.service_url + 'users/blogs/update'
                , {
                    data:
                    {
                        title: $scope.selectedBlog.title,
                        sub_cat_id:$scope.selectedSubCategory.id,
                        content:$scope.htmlVariable,
                        blog_id:$routeParams.blog_id,
                        visibility_id: $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    console.log(data);
                    //toastr.success(data.message, 'Blog');

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
                                toastr.success('Blog updated and published successfully');

                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Blog');

                            }).then(function()
                            {
                                $location.path('/myblogs/' + $scope.loggedInUserId);
                            });
                    }
                    else
                    {
                        console.log(data.data);
                        $http.post($scope.service_url + 'users/blogs/'+data.data.id+'/editasdraft'
                            , {
                                headers: {'Content-Type': 'application/json'}
                            }).
                            success(function (data, status, headers, config)
                            {
                                //toastr.success(data.message, 'Blog');
                                toastr.success('Blog saved as draft');

                            }).error(function (data)
                            {
                                toastr.error(data.error.message, 'Blog');

                            }).then(function()
                            {
                                $location.path('/myblogs/' + $scope.loggedInUserId);
                            });
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




    $scope.GetSubCategoryById = function(subCatId)
    {
        angular.forEach($scope.subcategories, function (value, key)
        {
            if($scope.selectedBlog.subcategory.id == value.id)
            {
                $scope.selectedSubCategory = value;
            }
        });
    }

    $scope.GetBlogById = function(blogId)
    {
        $http.get(PATHS.api_url + 'users/blogs/'+blogId).
            success(function (data)
            {
                $scope.selectedBlog = data.data;
                $scope.htmlVariable = $scope.selectedBlog.content;
                $scope.title = $scope.selectedBlog.title;
                $scope.blogGrade = $scope.selectedBlog.scale;

            }).error(function(data)
            {

            }).then(function(data)
            {
                $scope.GetCategories();
            });
    }

    

    $scope.onSelectSubPart = function(subcategory)
    {
        $scope.selectedsubcategories = subcategory;
    }

    $scope.onSelectPart = function(category)
    {
        $http.get(PATHS.api_url + 'subcategories/' + category.id).
            success(function (data)
            {
                $scope.subcategories = data.data;

            }).then(function(data)
            {
            });
    }

    $scope.onSelectVisibilityPart = function(visibility)
    {
        $scope.selectedVisibility = visibility;
    }

    $scope.convertToDate = function (stringDate){
        var dateOut = new Date(stringDate);
        dateOut.setDate(dateOut.getDate());
        return dateOut;
    };


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
                    $scope.coverImage = PATHS.api_url +'image/show/'+data;
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
        $scope.coverImage = PATHS.api_url +'image/show/'+data;
    });

    if($routeParams.blog_id)
    {
        $scope.GetVisibility();
        $scope.GetBlogById($routeParams.blog_id);

       // $scope.GetSubCategories();

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
