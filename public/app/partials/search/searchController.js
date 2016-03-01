/**
 * Created by creativethoughtssystechindiaprivatelimited on 28/12/14.
 */
evezownApp.controller('searchController', function ($scope, FileUploader, PATHS, usSpinnerService, $http,
                                                Session, $location, $cookieStore, Lightbox, $rootScope, ngDialog,$routeParams) {


    $scope.imagePath = PATHS.api_url;
    $scope.location = null;

    $scope.imageNames = [];
    $scope.currentPage = 1;
    $scope.currentUserId = $cookieStore.get('userId');
    $scope.dynamic = 0;

    $scope.isActive = ['', '', '', '', 'active'];

    $scope.myposts = [];
    $scope.visibilties = [];
    $scope.loggedInUser = $cookieStore.get('userId');
    $scope.postSearchResult = [];
    
    
    if ($location.path() == 'search/advanced') {
            $scope.isActive = ['', '', '', '', 'active'];
        }

	$scope.SearchPost = function()
    {
       if($scope.search_title == undefined || $scope.search_title == "")
       {
           toastr.error('Please enter a search key', 'Stream It');
       }
       else
       {
          $scope.NoResult = false;
           var typeId = "";
           var classificationId = "";
           var brandId = "";
           var Search_cat = "";
           var Search_subcat = "";
           var Search_price= "";
           
           if($scope.Search_type)
           {
               typeId = $scope.Search_type;
           }

           if($scope.Search_classification)
           {
               classificationId = $scope.Search_classification;
           }

           if($scope.Search_brand)
           {
               brandId = $scope.Search_brand;
           }

           if($scope.Category)
           {
               Search_cat = $scope.Category;
           }

           if($scope.subcategory)
           {
               Search_subcat = $scope.subcategory;
           }

           if($scope.Search_price)
           {
               Search_price = $scope.Search_price;
           }

           $http.post(PATHS.api_url + 'posts/post/search'
               , {
                   data: {
                       title: $scope.search_title,
                       postTypeId: typeId,
                       search_classifi: classificationId,
                       postBrand: brandId,
                       search_cat: Search_cat,
                       search_subcat: Search_subcat,
                       priceRange: Search_price,
                       userId:$scope.currentUserId
                   },
                   headers: {'Content-Type': 'application/json'}
               }).
               success(function (data, status, headers, config)
               {
                   $scope.postSearchResult = data.data;
                   if($scope.postSearchResult == 0)
                   {
                    $scope.NoResult = true;
                   }
               }).error(function (data)
               {
                   toastr.error(data.error.message, 'Stream It');
               });
       }
    }

    $scope.GetCategories = function()
    {
        $http.get(PATHS.api_url + 'categories/1').
            success(function (data) {
                $scope.categories = data.data;
                usSpinnerService.stop('spinner-1');
            });
    }
    $scope.GetSubCategories = function () {
        /*usSpinnerService.spin('spinner-1');*/
        $http.get(PATHS.api_url + 'subcategories/' + $scope.Category).
            success(function (data) {
                $scope.Subcategory = data.data;
                
                /*usSpinnerService.stop('spinner-1');*/
            });
    }
    $scope.LoadPostType = function()
    {
        $http.get(PATHS.api_url + 'posttypes').
            success(function (data)
            {
                var postType = data;
                $scope.PostTypes = [];
                $scope.Classifications = [];
                for(var i=0; i < postType.length; i++)
                {
                    var value = postType[i];
                    if (value.Post_Type == '0') {
                        $scope.PostTypes.push(value);
                    }
                }
                for(var i=0; i < postType.length; i++)
                {
                    var value = postType[i];
                    if (value.Post_Type == '1') {
                        $scope.Classifications.push(value);
                    }
                }
            });
    }
    $scope.LoadBrand = function(){
    	$http.get(PATHS.api_url + 'brands/' + 421).
        success(function (data) {
            $scope.brands = data.data;
        });
   	}
    
    $scope.GetCategories();
    $scope.LoadPostType();
    $scope.LoadBrand();
});