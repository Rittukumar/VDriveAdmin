'use strict';


evezownApp.controller('forums' ,function($scope, friendsService, PATHS,$http,$cookieStore,ngDialog,$rootScope,$routeParams,FileUploader,$location,Lightbox)
{
    $scope.caption = true;
    $scope.service_url = PATHS.api_url;
    $scope.loggedInUserId = $cookieStore.get('userId');
    $rootScope.allForums = [];
    $rootScope.myForums = [];
    $rootScope.selectedForum = "";
    $scope.visibilties = [];
    $scope.forumGrade;
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

    
    $scope.CreateForum = function()
    {
        ngDialog.open({ template: 'templateId' });
    }

    if($routeParams.id != undefined)
    {
        $scope.currentUserId = $routeParams.id;
    }
    else
    {
        $scope.currentUserId = $scope.loggedInUserId
    }

    $scope.GetMyForums = function()
    {
        if($routeParams.id != undefined)
        {
            $scope.currentUserId = $routeParams.id;
        }
        else
        {
            $scope.currentUserId = $scope.loggedInUserId
        }
        $http.get(PATHS.api_url + 'users/'+$scope.currentUserId+'/forums').
            success(function (data)
            {
                $rootScope.myForums = data.data;
            });
    }

    $scope.$watch('myForums', function(newvalue,oldvalue)
    {
        $rootScope.myForums = newvalue;
    });

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

    $scope.GetSub = function ()
    {
         $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedCategory.id).
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
                                $scope.selectedSubCategory = value;
                                notFound = false;
                            }
                        }
                    });

                    if(notFound)
                    {
                        $scope.selectedSubCategory = $scope.subcategories[0];
                    }

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
                        if($rootScope.selectedForum)
                        {
                            if(value.id == $rootScope.selectedForum.subcategory.id)
                            {
                                $scope.selectedBrand = value;
                                notFound = false;
                            }
                        }
                    });

                    if(notFound)
                    {
                        $scope.selectedBrand = $scope.brands[0];
                    }
                }
            });
    }

    $scope.SaveForum = function()
    {
        if(!$scope.forum)
        {
            toastr.error("Please enter title", 'Discussion');
        }
        else if(!$scope.description)
        {
            toastr.error("Please enter description", 'Discussion');
        }
        else if($scope.selectedOption.category_name == "Not Specified")
        {
            toastr.error("Please select a category", 'Discussion');
        }
        else
        {
            $http.post($scope.service_url + 'users/forums/create'
                , {
                    data:
                    {
                        title: $scope.forum,
                        owner_id:$cookieStore.get('userId'),
                        description:$scope.description,
                        sub_cat_id:$scope.selectedsubcategories.id,
                        visibility_id : $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    console.log(data);
                    ngDialog.close();
                    toastr.success(data.message, 'Discussion');
                    $scope.Forum_Id = data.id;

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Discussion');

                }).then(function()
                {
                    $location.path('/forums/'+$scope.Forum_Id);
                    //$scope.forum = "";
                    //$scope.description = "";
                    //$scope.GetMyForums();
                });
        }
    }

    $scope.DeleteForum = function(forum)
    {
        //users/forums/{forum_id}/delete
        $http.get(PATHS.api_url + 'users/forums/'+forum.id+'/delete').
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Discussion');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Discussion');

            }).then(function()
            {
                $location.path('/forums')
                $scope.GetMyForums();

            });
    }

    $scope.WoiceIt = function()
    {
        ngDialog.open({ template: 'WoicetemplateId' });
    }

    $scope.EditForum = function()
    {
        ngDialog.open({ template: 'EdittemplateId' });
    }

    $scope.CreateWoice = function (forum)
    {
        var postImages = [];
        if($scope.WoiceTitle == undefined)
        {
            toastr.error("Please enter title", 'Discussion');
        }
        else
        {
            $http.post(PATHS.api_url + 'users/' + $cookieStore.get('userId') + '/post/create'
                , {
                    data: {
                        title: $scope.WoiceTitle,
                        owner_id: $cookieStore.get('userId'),
                        description: $scope.Woicedescription,
                        testimonial: forum.description,
                        visibility_id: 1,
                        post_type_id: 1,
                        url_link: '#forums/'+forum.id,
                        images: postImages
                    },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Discussion');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Discussion');
                });
        }

    }

    $scope.UpdateForum = function(forum)
    {
        if(!$scope.selectedForum.topic_title)
        {
            toastr.error("Please enter title", 'Discussion');
        }
        else if(!$scope.selectedForum.topic_description)
        {
            toastr.error("Please enter description", 'Discussion');
        }
        else if($scope.selectedCategory.category_name == "Not Specified")
        {
            toastr.error("Please select a category", 'Discussion');
        }
        else
        {
            $http.post($scope.service_url + 'users/forums/update'
                , {
                    data:
                    {
                        title: forum.topic_title,
                        description:forum.topic_description,
                        forum_id : forum.id,
                        sub_cat_id : $scope.selectedSubCategory.id,
                        visibility_id : $scope.selectedVisibility.id
                    },
                    headers: {'Content-Type': 'application/json'}
                }).
                success(function (data, status, headers, config)
                {
                    ngDialog.close();
                    toastr.success(data.message, 'Discussion');

                }).error(function (data)
                {
                    toastr.error(data.error.message, 'Discussion');
                }).then(function()
                {
                    $scope.GetMyForums();
                });
        }
    }

    $scope.GetAllForums = function()
    {
        $http.get(PATHS.api_url + 'users/forums/all').
            success(function (data)
            {
                console.log(data);
                $rootScope.allForums = data.data;
                $scope.GetForumsById($routeParams.forumid);
            });
    }

    $scope.GetForumsById = function(forumId)
    {
        $http.get(PATHS.api_url + 'users/forums/'+forumId).
            success(function (data)
            {
                console.log(data.data);
                $rootScope.selectedForum = data.data;
                $scope.forumGrade = $rootScope.selectedForum.scale;
                $scope.GetVisibility();
            }).error(function(data)
            {

            }).then(function(data)
            {
                $scope.GetCategories();
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
                $scope.GetForumSubCategories();
            });
    }

    $scope.GetCategoryById = function()
    {
        angular.forEach($scope.categories, function (value, key)
        {
            if($rootScope.selectedForum.subcategory.category.id == value.id)
            {
                $scope.selectedCategory = value;
            }
        });
    }

    $scope.GetForumSubCategories = function ()
    {
        $http.get(PATHS.api_url + 'subcategories/' + $rootScope.selectedForum.subcategory.category.id).
            success(function (data)
            {
                $scope.subcategories = data.data;
                $scope.GetForumSubCategoryById();

            });
    }

    $scope.GetForumSubCategoryById = function()
    {
        angular.forEach($scope.subcategories, function (value, key)
        {
            if($rootScope.selectedForum.subcategory.id == value.id)
            {
                $scope.selectedSubCategory = value;
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
                    $scope.GetForumVisibility();
                }
            });
    }

    $scope.GetForumVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        angular.forEach($scope.visibilties, function (value, key)
        {
            if($rootScope.selectedForum.visibility_id == value.id)
            {
                $scope.selectedVisibility = value;
                $rootScope.showVisibility = value;
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
                if ($scope.categories.length > 0) {
                    $scope.selectedOption = $scope.categories[5];
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

    $scope.CreateComment = function(forumActivityId)
    {
        //users/groups/activities/comment/add
        $http.post($scope.service_url + 'users/forums/reply/add'
            , {
                data:
                {
                    reply: $scope.addedcomment,
                    user_id:$cookieStore.get('userId'),
                    forum_id:forumActivityId
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Discussion');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Discussion');

            }).then(function()
            {
                $scope.addedcomment = "";
                $scope.GetForumsById($routeParams.forumid);
            });
    }

    $scope.GetForumGrade = function(forum_id)
    {
        $http.get($scope.service_url + 'users/forums/grade/'+forum_id+'/get').
            success(function (data)
            {
                $scope.forumGrade = data;
            });
    }


    $scope.UpdateForumGrade = function(scale,forum_id)
    {
        $http.post($scope.service_url + 'users/forums/grade/add'
            , {
                data:
                {
                    scale:scale,
                    forum_id : forum_id,
                    owner_id: $cookieStore.get('userId')
                },
                headers: {'Content-Type': 'application/json'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.eventGrade = data.avgGrade;
                toastr.success(data.message, 'Discussion');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Discussion');
            }).then(function()
            {

                $scope.GetForumsById(forum_id);
            });
    }

    $scope.DeleteClick = function(comment)
    {
        $http.get(PATHS.api_url + 'users/forums/reply/'+comment.id+'/remove')
            .
            success(function (data, status, headers, config)
            {
                toastr.success(data.message, 'Groups');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Groups');

            }).then(function()
            {
                $scope.GetForumsById($routeParams.forumid);
            });
    }
    $scope.GetVisibility();
    $scope.LoadAllData();
    $scope.GetMyForums();
    if($routeParams.forumid)
    {
        $scope.GetForumsById($routeParams.forumid);
    }
  //  $scope.GetAllForums();
});
