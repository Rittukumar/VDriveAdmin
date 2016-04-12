'use strict';


evezownApp.controller('trending', function ($scope, FileUploader, PATHS, usSpinnerService, $http,
                                                Session, $location, $cookieStore, Lightbox, $rootScope, ngDialog,$routeParams) {


    //if(!Session.userId)
    //{
    //    $location.path("/login");
    //}
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
    $scope.myposts = [];
    $scope.visibilties = [];
    $scope.loggedInUser = $cookieStore.get('userId');
    $scope.selectEves = 'all eves';
    $rootScope.currentItemId = '';
    $scope.postSearchResult = [];
    $rootScope.UserCircles = [];
    $scope.Showcircles = false;
    $scope.SelectedCircle = [{id:"", title:""}];
    //$scope.isRecco = false;

    $scope.buttonTitle = "Stream It";

    $scope.editing = false;



    if ($location.path() == '/streamit') {
        $scope.isActive = ['', '', 'active', '', ''];
    }
    else {
        $scope.isActive = ['active', '', '', '', ''];
    }


    if($routeParams.id != undefined)
    {
        $scope.currentUserId = $routeParams.id;
        $scope.isProfile = true;
    }
    else
    {
        $scope.currentUserId = $cookieStore.get('userId');
        $scope.isProfile = false;
    }

    usSpinnerService.spin('spinner-1');

    $scope.convertToDate = function (stringDate) {
        var dateOut = new Date(stringDate);
        dateOut.setDate(dateOut.getDate());
        return dateOut;
    };

    $scope.getRole = function ($userId) {
        $http.get(PATHS.api_url +  'users/' + $userId)
            .success(function(data){
                $scope.CheckRole = data.data.role;
            })
            .error(function(err){
                console.log('Error retrieving user');
            });
    }

    $scope.GetPostByFilter = function (itemId)
    {
        //$scope.currentUserId = $routeParams.id;
        if (!$cookieStore.get('api_key')) {
            $location.path('/login');
        }
        $scope.url = '';
        if (itemId == '')
        {
            /*if ($location.path() != '/recco')
            {
                if ($scope.currentUserId)
                {
                    $scope.url = PATHS.api_url + 'posts/woice/' + $scope.currentUserId;
                }
                else {
                    $scope.url = PATHS.api_url + 'posts/woice' + $cookieStore.get('userId');
                }
            }*/
            /*else
            {*/
                if ($scope.currentUserId)
                {
                    $scope.url = PATHS.api_url + 'posts/recco/' + $scope.currentUserId;
                }
                else {
                    $scope.url = PATHS.api_url + 'posts/recco' + $cookieStore.get('userId');
                }
            /*}*/
        }
        else
        {
            if($scope.currentUserId)
            {
                $scope.url = PATHS.api_url + 'posts/' + $scope.currentUserId + '/type/' + itemId;
            }
            else
            {
                $scope.url = PATHS.api_url + 'posts/' + $cookieStore.get('userId') + '/type/' + itemId;
            }
        }
        $http.get($scope.url).
            success(function (data) {
                if (itemId == '') {
                    $rootScope.all = 'active';
                    $rootScope.generic = '';
                    $rootScope.reco = '';
                    $rootScope.finds = '';
                    $rootScope.caution = '';
                }
                else if (itemId == '2') {
                    $rootScope.all = '';
                    $rootScope.generic = 'active';
                    $rootScope.reco = '';
                    $rootScope.finds = '';
                    $rootScope.caution = '';
                }
                else if (itemId == '1') {
                    $rootScope.all = '';
                    $rootScope.generic = '';
                    $rootScope.reco = 'active';
                    $rootScope.finds = '';
                    $rootScope.caution = '';
                }
                else if (itemId == '4') {
                    $rootScope.all = '';
                    $rootScope.generic = '';
                    $rootScope.caution = 'active';
                    $rootScope.finds = '';
                    $rootScope.reco = '';
                }
                else if (itemId == '3') {
                    $rootScope.all = '';
                    $rootScope.generic = '';
                    $rootScope.finds = 'active';
                    $rootScope.caution = '';
                    $rootScope.reco = '';
                }
                $scope.posts = data.data;
                //if ($location.path() != '/recco')
                //{
                //    var posts = $scope.posts;
                //    var newPosts = [];
                //    for(var i=0; i < posts.length; i++)
                //    {
                //        var value = posts[i];
                //        if (value.post_type_id == '1' || value.post_type_id == '2' || value.post_type_id == '3'|| value.post_type_id == '4') {
                //            newPosts.push(value);
                //        }
                //    }
                //    $scope.posts = newPosts;
                //}
                //else
                //{
                //    var posts = $scope.posts;
                //    var newPosts = [];
                //    for(var i=0; i < posts.length; i++)
                //    {
                //        var value = posts[i];
                //        if (value.post_type_id == '5' || value.post_type_id == '6' || value.post_type_id == '7'|| value.post_type_id == '8') {
                //            newPosts.push(value);
                //        }
                //    }
                //    $scope.posts = newPosts;
                //}

            });
    }


    $scope.ShowReportPopup = function()
    {
        ngDialog.open({ template: 'reporttemplateId' });
    }

    $scope.ReportPost = function()
    {
        toastr.error("Post reported successfully.", 'Stream It');
        ngDialog.close();
    }

    $scope.GetMyPostByFilter = function (itemId)
    {
        //$scope.currentUserId = $routeParams.id;
        if (!$cookieStore.get('api_key')) {
            $location.path('/login');
        }
        $scope.url = '';

        if($scope.currentUserId)
        {
            $scope.url = PATHS.api_url + 'users/' + $scope.currentUserId+ '/posts';
        }
        else
        {
            $scope.url = PATHS.api_url + 'users/' + $cookieStore.get('userId')+ '/posts';
        }
        $http.post($scope.url, { loggedin_user_id : $cookieStore.get('userId')}).
            success(function (data) {
                if (itemId == '') {
                    $rootScope.all = 'active';
                    $rootScope.generic = '';
                    $rootScope.reco = '';
                    $rootScope.finds = '';
                    $rootScope.caution = '';
                }
                else if (itemId == '2') {
                    $rootScope.all = '';
                    $rootScope.generic = 'active';
                    $rootScope.reco = '';
                    $rootScope.finds = '';
                    $rootScope.caution = '';
                }
                else if (itemId == '1') {
                    $rootScope.all = '';
                    $rootScope.generic = '';
                    $rootScope.reco = 'active';
                    $rootScope.finds = '';
                    $rootScope.caution = '';
                }
                else if (itemId == '4') {
                    $rootScope.all = '';
                    $rootScope.generic = '';
                    $rootScope.caution = 'active';
                    $rootScope.finds = '';
                    $rootScope.reco = '';
                }
                else if (itemId == '3') {
                    $rootScope.all = '';
                    $rootScope.generic = '';
                    $rootScope.finds = 'active';
                    $rootScope.caution = '';
                    $rootScope.reco = '';
                }
                $scope.myposts = data.data;

            });
    }

    $scope.PriorityCheck = function(value)
    {
        $scope.priority = value;
    }

    $scope.CreateWoice = function ()
    {
        if ($scope.url_link != undefined && !$scope.url_link.startsWith("http://")) {
            $scope.url_link = "http://"+$scope.url_link;
        }
        usSpinnerService.spin('spinner-2');
        $http.post(PATHS.api_url + 'users/' + $cookieStore.get('userId') + '/post/create'
            , {
                data: {
                    title: $scope.woice,
                    owner_id: Session.userId,
                    description: $scope.description,
                    visibility_id: $scope.selectedVisibility.id,
                    post_type_id: $scope.selectedType.id,
                    classification_id: $scope.selectedClassifieds.id,
                    category_id: $scope.selectedOption.id,
                    subcategory_id: $scope.selectedsubcategories.id,
                    price_range: $scope.price,
                    testimonial: $scope.recommendation,
                    brand_id: $scope.selectedBrand.id,
                    location: $scope.location,
                    url_link: $scope.url_link,
                    circle_id: $scope.SelectedCircle.id,
                    images: $scope.imageNames
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config) {
                $scope.woice = null;
                $scope.description = null;
                $scope.price = null;
                $scope.recommendation = null;
                $scope.location = null;
                $scope.url_link = null;
                $scope.imageNames = [];
                $scope.GetPostByFilter($rootScope.currentItemId);
                usSpinnerService.stop('spinner-2');
                toastr.success(data.message, 'Stream It');
            }).error(function (data) {
                $scope.woice = null;
                $scope.description = null;
                $scope.price = null;
                $scope.recommendation = null;
                $scope.location = null;
                $scope.url_link = null;
                $scope.imageNames = [];
                usSpinnerService.stop('spinner-2');
                toastr.error(data.error.message, 'Stream It');
            }).then(function(data)
            {
                if($scope.priority == 1)
                {
                    $scope.UpdatePriority('1',data.data.post_id)
                }
            });
    }

    $scope.UpdatePriority = function (priority,postId)
    {
        $http.post(PATHS.api_url + 'posts/'+ postId +'/priority/update'
            , {
                data: {
                    priority: priority
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (data, status, headers, config) {
                $scope.GetPostByFilter($rootScope.currentItemId);
                usSpinnerService.stop('spinner-1');
            });
    }

    $scope.PriorityReupdate = function (Priority,postId) {
        
        if ( Priority == 1) {
          $scope.UpdatePriority('0',postId)
          toastr.success('Priority updated successfully');
        }

        else {
          $scope.UpdatePriority('1',postId)
          toastr.success('Priority updated successfully');
        }
    }

    $scope.UpdateWoice = function ($post)
    {
        $http.post(PATHS.api_url + 'updatePost'
            , {
                data: {
                    title: $post.title,
                    description: $post.description,
                    id: $post.id,
                    testimonial: $post.testimonial,
                    price: $post.price_range,
                    visibility_id:$post.visibility_id
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                    $scope.GetPostByFilter('');
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Stream It');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Stream It');
            });
    }

    $scope.UpdateWoiceVisibility = function ($post,$visibility)
    {
        $http.post(PATHS.api_url + 'updatePost'
            , {
                data: {
                    title: $post.title,
                    description: $post.description,
                    id: $post.id,
                    testimonial: $post.testimonial,
                    price: $post.price_range,
                    visibility_id:$visibility.id
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.GetPostByFilter('');
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Stream It');
            }).error(function (data)
            {
                toastr.error(data.error.message, 'Stream It');
            });
    }

    $scope.DeleteWoice = function ($woiceId)
    {
        $http.get(PATHS.api_url + 'deletePost/'+$woiceId).
            success(function (data)
            {
                $scope.GetPostByFilter('');
                toastr.success(data.message, 'Stream It');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Stream It');
            });
    }

    //Loading all posts by userid
    $scope.LoadPostsByFilter = function (itemId)
    {
        $scope.GetPostByFilter(itemId);
    }

    // Open the add brand dialog.
    $scope.addBrand = function () {
        ngDialog.open({ template: 'templateId' });
    };


    /*if ($location.path() != '/recco') {
        $scope.LoadPostsByFilter('');
    }
    else {
        $scope.LoadPostsByFilter('5');
    }*/

    $scope.postSettingsItems = [{
        name: "Edit Post"
        }, {
        name: "Delete Post"
        }, {
        name: "Report Post"
    }];

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
        //$scope.counter = addedFileItems.length;
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
        $scope.ImageCounter = fileItem.uploader.queue.length;

        if($scope.isUploadingBrand)
        {
            var NewBrand = $scope.brandname;
            var newbrand = NewBrand.toLowerCase();
            $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
                success(function (data) {
                    $scope.brandCheck = data.data;
                    $scope.BrandTest=false;
                    angular.forEach($scope.brandCheck, function (value, key)
                    {
                        var BrandTitle = value.title;
                        var brandtitle = BrandTitle.toLowerCase();
                        if (brandtitle == newbrand) {
                           $scope.BrandTest=true;
                        }
                    });
                    if($scope.BrandTest){
                        toastr.error('Brand Exists Already, Enter Brand Name in Search Box');
                    }
                    else{
                          $http.post(PATHS.api_url + 'brands/add'
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
                                //$scope.ReloadBrandOnAdd();
                                $scope.brandname = '';
                                $scope.isUploadingBrand = false;
                                ngDialog.close();
                                usSpinnerService.stop('spinner-1');
                                toastr.success(data.message, 'Enter Brand Name in Search Box');
                            }).error(function (data)
                            {
                                $scope.isUploadingBrand = false;
                                $scope.brandname = '';
                                usSpinnerService.stop('spinner-1');
                                toastr.error(data.error.message, 'Stream It');
                            }).then(function(data)
                            {
                                $scope.LoadRecentAddedBrand(data.data.Brand_id);
                            });
                        }
                }); 
        }
        else
        {
            $scope.imageNames.push(response.imageName);
            $scope.ImageCounter;

            if($scope.ImageCounter == 1)
            {
                if (!$scope.woice) {
                    toastr.error("Please enter Title", 'Stream It');
                }
                else if (!$scope.description) {
                    toastr.error("Please enter Description", 'Stream It');
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

    //Show hide circles div
    $scope.ShowCircles = function (selectedVisibility)
    {
        if(selectedVisibility.id == 2)
        {
            $scope.Showcircles = true;
        }
        else
        {
            $scope.Showcircles = false;
            $scope.SelectedCircle = [{id:"", title:""}];
        }   
    }

    //Get circles created by the loggedin user
    $scope.GetUserCircles = function ()
    {     
        $scope.loggedInUserId = $cookieStore.get('userId');
        $http.get(PATHS.api_url + 'users/'+$scope.loggedInUserId+'/circles').
        success(function (data, status, headers, config)
        {
            $rootScope.UserCircles = data.data;
        }).error(function (data)
        {
            console.log(data);
        });
    }
    $scope.GetUserCircles();

    //Get Selectedcircles for the posts
    $scope.GetSelectedCircle = function (circle_id,UserCircles)
    {
        $scope.PostCircle = null;
        angular.forEach(UserCircles, function (value, key)
            {
                if(value.id == circle_id)
                {
                    $scope.PostCircle =  value;
                }
            });
        return $scope.PostCircle;
    }

    //Change Circle visibility
    $scope.ChangeCircle = function($post,$circle)
    {
       
       $http.post(PATHS.api_url + 'updatePost/circle'
        , {
            data: {
                post_id: $post.id,
                circle_id: $circle.id
            },
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).
        success(function (data, status, headers, config)
        {
            $scope.GetPostByFilter('');
            usSpinnerService.stop('spinner-1');
            toastr.success(data.message, 'Stream It');
        }).error(function (data)
        {
            toastr.error(data.error.message, 'Stream It');
        });
    }

    //Create a post .. (Recco, Caution, finds generic.)
    $scope.CreatePost = function (files,posts)
    {
        if (!$scope.woice) {
            toastr.error("Please enter Title", 'Stream It');
        }
        else if (!$scope.description) {
            toastr.error("Please enter Description", 'Stream It');
        }
        else if (!$scope.selectedVisibility) {
            toastr.error("Please select visibility", 'Stream It');
        }
        else
        {
            if(files.queue.length > 0)
            {
                files.uploadAll();
            }
            else
            {
                $scope.CreateWoice();
            }
        }
    }

    //Loading categories here.

    $scope.LoadAllData = function()
    {
        $http.get(PATHS.api_url + 'categories/1').
            success(function (data) {
                $scope.categories = data.data;
                if ($scope.categories.length > 0) {
                    $scope.selectedOption = $scope.categories[5];
                    $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedOption.id).
                        success(function (data) {
                            $scope.subcategories = data.data;
                            if ($scope.subcategories.length > 0) {
                                $scope.selectedsubcategories = $scope.subcategories[0];
                                $rootScope.currentSelectedSubCategoryId = $scope.selectedsubcategories.id;
                                $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
                                    success(function (data) {
                                        $rootScope.brands = data.data;
                                        if ($rootScope.brands.length > 0)
                                        {
                                            $rootScope.selectedBrand = $rootScope.brands[0];
                                        }
                                    });
                            }
                        });

                }
                usSpinnerService.stop('spinner-1');
            });
    }


    $scope.GetNextSetOfPosts = function (itemId)
    {
        //$scope.currentUserId = $routeParams.id;
        if (itemId == '')
        {
            if($scope.currentUserId)
            {
                $scope.url = PATHS.api_url + 'posts/' + $scope.currentUserId + '?page=' + $scope.currentPage;
            }
            else
            {
                $scope.url = PATHS.api_url + 'posts/' + $cookieStore.get('userId') + '?page=' + $scope.currentPage;
            }
        }
        else
        {
            if($scope.currentUserId) {
                $scope.url = PATHS.api_url + 'posts/' + $scope.currentUserId + '/type/' + itemId + '?page=' + $scope.currentPage;
            }
            else
            {
                $scope.url = PATHS.api_url + 'posts/' + $cookieStore.get('userId') + '/type/' + itemId + '?page=' + $scope.currentPage;
            }
        }
        $http.get($scope.url).
            success(function (data) {
                $scope.itemsPerPage = data.meta.pagination.per_page;
                $scope.currentPage = data.meta.pagination.current_page;
                $scope.total = data.meta.pagination.total;
                $scope.posts = $scope.posts.concat(data.data);
                if ($location.path() == '/streamit')
                {
                    var posts = $scope.posts;
                    var newPosts = [];
                    for(var i=0; i < posts.length; i++)
                    {
                        var value = posts[i];
                        if (value.post_type_id == '1' || value.post_type_id == '2' || value.post_type_id == '3'|| value.post_type_id == '4') {
                            newPosts.push(value);
                        }
                    }
                    $scope.posts = newPosts;
                }
                else
                {
                    var posts = $scope.posts;
                    var newPosts = [];
                    for(var i=0; i < posts.length; i++)
                    {
                        var value = posts[i];
                        if (value.post_type_id == '5' || value.post_type_id == '6' || value.post_type_id == '7'|| value.post_type_id == '8') {
                            newPosts.push(value);
                        }
                    }
                    $scope.posts = newPosts;
                }
            });
    }

    $scope.LoadPostType = function()
    {
        //Loading post types here (Warning,Recco,Finds,Generic)
        $http.get(PATHS.api_url + 'posttypes').
            success(function (data)
            {
                if($location.path() == '/streamit' || $location.path() == '/search/advanced')
                {
                    var postType = data;
                    var newTypes = [];
                    for(var i=0; i < postType.length; i++)
                    {
                        var value = postType[i];
                        if (value.Post_Type == '0') {
                            newTypes.push(value);
                        }
                    }
                    //angular.forEach(postType, function (value, key)
                    //{
                    //    if (value.Post_Type == '0') {
                    //        var index = postType.indexOf(value)
                    //        postType.splice(index);
                    //    }
                    //});
                    $scope.posttypes = newTypes;
                    //$scope.isRecco = true;
                    $scope.buttonTitle = "Stream It";
                    $scope.postTitle = "Create your Stream It";
                    $scope.PageSubTitle = "Stream It";
                    $scope.PageDescription = "Promote, recommend or endorse a Stores or a Business service or both. It helps to create awareness and draw attention. Any member can recommend what or whom they believe in on account of direct experience with the product, service, person or place. This place is used for positive experiences as we have included ‘Be careful’ to voice negative experiences. It is in effect a good tool for word of mouth… spreading the word online.";
                }
                else
                {
                    $scope.posttypes = data;
                }
                if ($scope.posttypes.length > 0)
                {
                    $scope.selectedType = $scope.posttypes[1];
                }
            });
    }

    $scope.ReccoClasifieds =function()
    {
        $http.get(PATHS.api_url + 'posttypes').
            success(function (data)
            {
                
                    var ClassifiedsType = data;
                    var newClassifiedsTypes = [];
                    for(var i=0; i < ClassifiedsType.length; i++)
                    {
                        var value = ClassifiedsType[i];
                        if (value.Post_Type == '1')
                        {
                            newClassifiedsTypes.push(value);
                        }
                    }

                    $scope.classifieds_types = newClassifiedsTypes;
                    if ($scope.classifieds_types.length > 0)
                    {
                        $scope.selectedClassifieds = $scope.classifieds_types[1];
                    }
            });
    }

    $scope.SearchPost = function()
    {

       if($scope.search_title == undefined || $scope.search_title == "")
       {
           toastr.error('Please enter a search key', 'Stream It');
       }
       else
       {
           var brandId = "";
           var typeId = "";
           var classificationId = "";
           var Search_cat = "";
           var Search_subcat = "";
           var Search_price= "";
           
           if($scope.selectedType)
           {
               typeId = $scope.selectedType.id;
           }

           if($scope.Search_Brand)
           {
               brandId = $scope.Search_Brand.id
           }

           if($scope.Search_classification)
           {
               classificationId = $scope.Search_classification.id;
           }

           if($scope.selectedOption)
           {
               Search_cat = $scope.selectedOption.id;
           }

           if($scope.selectedsubcategories)
           {
               Search_subcat = $scope.selectedsubcategories.id;
           }

           if($scope.Search_price_range)
           {
               Search_price = $scope.Search_price_range;
           }

           $http.post(PATHS.api_url + 'posts/post/search'
               , {
                   data: {
                       title: $scope.search_title,
                       postTypeId: typeId,
                       postBrand: brandId,
                       priceRange: Search_price,
                       search_cat: Search_cat,
                       search_subcat: Search_subcat,
                       search_classifi: classificationId,
                       userId:$scope.currentUserId
                   },
                   headers: {'Content-Type': 'application/json'}
               }).
               success(function (data, status, headers, config)
               {
                   $scope.postSearchResult = data.data;
               }).error(function (data)
               {
                   toastr.error(data.error.message, 'Stream It');
               });
       }
    }



    $scope.GetVisibility = function()
    {
        //Loading user visibility section (with all,circle,friends,me)
        $http.get(PATHS.api_url + 'visibility').
            success(function (data) {
                $scope.visibilties = data;
                usSpinnerService.stop('spinner-1');
            }).then(function()
            {
                $scope.GetMyPostByFilter();
            });
    }




    $scope.GetVisibilityOfWoice = function(currentVisibiltyId,visibilties)
    {
        var selectedVisibility = null;
        angular.forEach(visibilties, function (value, key)
            {
                if(value.id == currentVisibiltyId)
                {
                    selectedVisibility =  value;
                }
            },
            visibilties);
        return selectedVisibility;
    }

    //Loading brands based on subcategoryId
    /*$scope.ReloadBrand = function () {

        $rootScope.currentSelectedSubCategoryId = $scope.selectedsubcategories.id;
        $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
            success(function (data) {
                $scope.brands = data.data;
                if ($scope.brands.length > 0) {
                    $scope.selectedBrand = $scope.brands[0];
                }
                usSpinnerService.stop('spinner-1');
            });
    }*/

    //Loading brands based on subcategoryId
    /*$scope.ReloadBrandOnAdd = function ()
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
    }*/

    //Load the Recent added brand and show it in the brand field
    $scope.LoadRecentAddedBrand = function (BrandID)
    {
        $scope.RecentBrand  = BrandID - 1;
        $http.get(PATHS.api_url + 'brands/' + $rootScope.currentSelectedSubCategoryId).
            success(function (data)
            {
                $rootScope.brands = data.data;
                if ($rootScope.brands.length > 0)
                {
                    $rootScope.selectedBrand = $rootScope.brands[$rootScope.brands.length - 1];
                }
                usSpinnerService.stop('spinner-1');
            });
    }

    //Loading subcategories based on categoryId
    $scope.GetSubCategories = function () {
        usSpinnerService.spin('spinner-1');
        $http.get(PATHS.api_url + 'subcategories/' + $scope.selectedOption.id).
            success(function (data) {
                $scope.subcategories = data.data;
                if ($scope.subcategories.length > 0) {
                    $scope.selectedsubcategories = $scope.subcategories[0];
                }
                usSpinnerService.stop('spinner-1');
            });
    }
    $scope.GetSection = function () {
        usSpinnerService.spin('spinner-1');
        $http.get(PATHS.api_url + 'categories/' + itemId).
            success(function (data)
            {
                $scope.sections = data.data;
                usSpinnerService.stop('spinner-1');
            });
    }

    //Hide and show section in create recco.
    $scope.ReloadView = function ()
    {

        if ($scope.selectedType.id == 1)
        {
            $scope.mustHideOnGeneric = true;
            $scope.mustHideOnWarning = false;
            $rootScope.currentItemId = "1";
            $rootScope.aboutPost = "Just sharing";
        }
        else if ($scope.selectedType.id == 4) {
            $scope.mustHideOnWarning = true;
            $scope.mustHideOnGeneric = true;
            $rootScope.currentItemId = "4";
            $rootScope.aboutPost = "Be careful. Watch out";
        }
        else if ($scope.selectedType.id == 3)
        {
            $rootScope.aboutPost = "Look What I found, bright, shiny and new";
            $scope.mustHideOnWarning = false;
            $rootScope.currentItemId = "3";
            $scope.mustHideOnGeneric = true;
        }
        else if ($scope.selectedType.id == 2) {
            $rootScope.aboutPost = "I recommend";
            $scope.mustHideOnWarning = true;
            $rootScope.currentItemId = "2";
            $scope.mustHideOnGeneric = true;
        }
        else
        {
            $rootScope.currentItemId = "";
            $scope.mustHideOnWarning = false;
            $scope.mustHideOnGeneric = true;
        }
    }


    $scope.$on('$destroy', function () {
        //$timeout.cancel(timeout);
    });

    $scope.loadMore = function () {
        $scope.currentPage++;
        if ($scope.all == 'active') {
            $scope.item = '';
        }
        else if ($scope.reco == 'active') {
            $scope.item = '1';
        }
        else if ($scope.generic == 'active') {
            $scope.item = '2';
        }
        else if ($scope.finds == 'active') {
            $scope.item = '3';
        }
        else if ($scope.caution == 'active') {
            $scope.item = '4';
        }
        $scope.GetNextSetOfPosts($scope.item);

    };

    $scope.nextPageDisabledClass = function () {
        return $scope.currentPage === $scope.pageCount() - 1 ? "disabled" : "";
    };

    $scope.pageCount = function ()
    {
        return Math.ceil($scope.total / $scope.itemsPerPage);
    };


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

    $scope.LoadComments = function (post) {
        $cookieStore.remove('post');
        $cookieStore.put('postId', post.id);
        $rootScope.selectedPost = post;
        $rootScope.seletedPostId = post.id;
        $location.path('/comments');
    }

    $scope.GetLevelsByUserId = function (post) {
        var grades = post.grades;
        var myGrade = 0;
        angular.forEach(grades, function (value, key) {
                if (value.owner_id == $cookieStore.get('userId')) {
                    myGrade = value.scale;
                }
            },
            grades);

        return myGrade;
    }

    $scope.AddRewoice = function (post) {
        // users/{user_id}/posts/{post_id}/rewoice
        $http.post(PATHS.api_url + 'users/' + $scope.currentUserId + '/posts/' + post.id + '/rewoice'
            , {
                data: {},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.GetPostByFilter($rootScope.currentItemId);
                toastr.success(data.message, 'Stream It');

            }).error(function (data) {
                toastr.error(data.error.message, 'Stream It');
            });
    }
    $scope.AddRewoiceForRecentActivity = function (post) {
        // users/{user_id}/posts/{post_id}/rewoice
        $http.post(PATHS.api_url + 'users/' + $scope.currentUserId + '/posts/' + post.id + '/rewoice'
            , {
                data: {},
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                
                $scope.GetMyPostByFilter($rootScope.currentItemId);
                toastr.success(data.message, 'Stream It');

            }).error(function (data) {
                toastr.error(data.error.message, 'Stream It');
            });
    }

    $scope.UpdateLevels = function (stars, post) {
        $http.post(PATHS.api_url + 'posts/' + post.id + '/grades/create'
            , {
                data: {
                    owner_id: $cookieStore.get('userId'),
                    scale: stars,
                    post_id: post.id
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.GetPostByFilter($rootScope.currentItemId);
                toastr.success(data.message, 'Stream It');

            }).error(function (data) {
                toastr.error(data.error.message, 'Stream It');
            });
    }

    //take a tour
    $scope.IntroOptions = {
            steps:[
                {
                    element: '#step1',
                    intro: "<b>&#10004;</b> This is your website on Evezown. <br><b>&#10004;</b> You can create your profile in depth. Build community to connect with friends or any one you wish to connect <br><b>&#10004;</b> You can promote yourself or your business digitally within your circles privately or publicly using features such as Events, Blogs, Stream It."
                },
                {
                    element: '#step3',
                    intro: '<b>&#10004;</b> Promote, recommend or endorse a product or a service or both <br><b>&#10004;</b> Create a title and a short description <br><b>&#10004;</b> Choose what the Stream It is about <br><b>&#10004;</b> Choose the category and the sub category <br><b>&#10004;</b> Add a brand name or product name (optional) <br><b>&#10004;</b> Provide price range (optional)',
                    position: 'bottom'
                },
                {
                    element: '#step4',
                    intro: "<b>&#10004;</b> Explore the two sections Marketplace and Jobs",
                    position: 'bottom'
                },
                {
                    element: '#step5',
                    intro: '<b>&#10004;</b> Use search feature to find what you are looking for <br><b>&#10004;</b> Search by key word,type of post, category, subcategory, brand, price or location'
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

    $scope.SaveBrand = function(files)
    {

        if(!$scope.brandname)
        {
            toastr.error('Please enter brand name', 'Stream It');
        }
        else
        {
            $scope.isUploadingBrand = true;
            if(files.queue.length > 0) //Brand with brandimage
            {
                files.uploadAll();
            }
            else //Brand with out image
            {
                var NewBrand = $scope.brandname;
                var newbrand = NewBrand.toLowerCase();
                $http.get(PATHS.api_url + 'brands/' + $scope.selectedsubcategories.id).
                success(function (data) {
                    $scope.brandCheck = data.data;
                    $scope.BrandTest=false;
                    angular.forEach($scope.brandCheck, function (value, key)
                    {
                        var BrandTitle = value.title;
                        var brandtitle = BrandTitle.toLowerCase();
                        if (brandtitle == newbrand) {
                           $scope.BrandTest=true;
                        }
                    });
                    if($scope.BrandTest){
                        toastr.error('Brand Exists Already, Enter Brand Name in Search Box');
                    }
                    else{
                        $http.post(PATHS.api_url + 'brands/add'
                        , {
                            data: {
                                //image_name: response.imageName,
                                title: $scope.brandname,
                                subCatId: $rootScope.currentSelectedSubCategoryId
                            },
                            headers: {'Content-Type': 'application/json'}
                        }).
                        success(function (data, status, headers, config)
                        {
                            //$scope.ReloadBrandOnAdd();
                            $scope.brandname = '';
                            ngDialog.close();
                            usSpinnerService.stop('spinner-1');
                            toastr.success(data.message, 'Enter Brand Name in Search Box');
                        }).error(function (data)
                        {
                            $scope.brandname = '';
                            usSpinnerService.stop('spinner-1');
                            toastr.error(data.error.message, 'Stream It');
                        }).then(function(data)
                        {
                            $scope.LoadRecentAddedBrand(data.data.Brand_id);
                        });
                    }
                }); 
            }
        }
    }

    $scope.GetVisibility();
    $scope.LoadAllData();
    $scope.GetPostByFilter($rootScope.currentItemId);
    $scope.LoadPostType();
    $scope.ReccoClasifieds();
    $scope.getRole($scope.loggedInUser);


});


