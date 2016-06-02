
'use strict';

evezownApp.controller('editCategoriesCtrl',
    function ($scope, $http, $routeParams, $cookieStore, PATHS, usSpinnerService,Session)
    {

        
    $scope.title = "Categories";
    $scope.allcategories = [];
    $scope.captions = [];
    $scope.showTable = false;
    $scope.AddCategoryBlock = false;
    $scope.AddSubCategoryBlock = false;

	//get all the Categories
    $scope.GetAllCategories = function()
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') +'/categories').
            success(function (data, status, headers, config)
            {
                console.log(data.categories);
                $scope.allcategories = data.categories;
                $scope.Categories = data.categories[0];
                $scope.GetSubCategories($scope.Categories.id);
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.GetAllCategories();

    //get all the SubCategories based on Categories
    $scope.GetSubCategories = function()
    {
    	$http.get(PATHS.api_url + 'subcategories/'+ $scope.Categories.id).
            success(function (data, status, headers, config)
            {
                console.log(data);
                $scope.SubCategories = data.data;
            }).error(function (data)
            {
                console.log(data);
            });

        $scope.showTable = true;


    }

    $scope.EditCategory = function(category)
    {
        console.log(category);
        $http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/saveCategory'
            , {
                data: {
                    Categories: category
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
                console.log(data);
                toastr.success('Category edited successfully');
                $scope.GetAllCategories();  
            }).error(function (data) {
                console.log(data);
                 toastr.error('Please try Later',"Something went wrong");
            });
    };

    $scope.EditSubCategory = function(subCategory)
    {
        $http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/saveSubCategory'
            , {
                data: {
                    SubCategories: subCategory
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
                console.log(data);
                toastr.success('Subcategory edited successfully');
                $scope.GetAllCategories();  
            }).error(function (data) {
                console.log(data);
                 toastr.error('Please try Later',"Something went wrong");
            });
    };

    $scope.AddCategory = function()
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/EvezownSections').
            success(function (data, status, headers, config)
            {
                console.log(data);
                $scope.EvezownSections = data.evezownSections;
                $scope.SelectedSections = data.evezownSections[0];
            }).error(function (data)
            {
                console.log(data);
            });

        $scope.AddCategoryBlock = true;
        $scope.AddSubCategoryBlock = false;
    }

    $scope.SaveCategories = function(category,sectionid)
    {
        if(!category)
        {
            toastr.error('please enter category');
        }
        else
        {
            var category = {'section_id':sectionid,'category_name':category};
            
            $http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/saveCategory'
            , {
                data: {
                    Categories: category
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
                console.log(data);
                toastr.success('Category added successfully');
                $scope.category_name = "";
                $scope.AddCategoryBlock = false;
                $scope.GetAllCategories();
            }).error(function (data) {
                console.log(data);
                 toastr.error('Please try Later',"Something went wrong");
            });
        }
    }

    $scope.AddSubCategory = function()
    {
        $scope.AddSubCategoryBlock = true;
        $scope.AddCategoryBlock = false;
    }

    $scope.SaveSubCategories = function(subcategory,categoryid)
    {
        if(!subcategory)
        {
            toastr.error('please enter subcategory');
        }
        else
        {
            var subCategory = {'subcategory_name':subcategory,'category_id':categoryid};
            
            $http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/saveSubCategory'
            , {
                data: {
                    SubCategories: subCategory
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
                console.log(data);
                toastr.success('Subcategory added successfully');
                $scope.sub_category_name = "";
                $scope.AddSubCategoryBlock = false;
                $scope.GetAllCategories();  
            }).error(function (data) {
                console.log(data);
                 toastr.error('Please try Later',"Something went wrong");
            });
        }
    }

    $scope.DeleteCategory = function(categoryid)
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') + '/' + categoryid + '/deletecategory').
            success(function (data, status, headers, config)
            {
                toastr.success('Category deleted successully');
                $scope.GetAllCategories();
            }).error(function (data)
            {
                toastr.error('Please try Later',"Something went wrong");
                $scope.GetAllCategories();
            });
    }

    $scope.DeleteSubCategory = function(subCategoryid)
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') + '/' + subCategoryid + '/deletesubcategory').
            success(function (data, status, headers, config)
            {
                toastr.success('Sub Category deleted successully');
                $scope.GetAllCategories();
            }).error(function (data)
            {
                toastr.error('Please try Later',"Something went wrong");
                $scope.GetAllCategories();
            });
    }
    
        
    });