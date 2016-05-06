'use strict';

evezownApp
    .controller('bloglists',
        function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService,
                            Session, ngDialog, $rootScope, $cookieStore, $location,
                            BlogService, $controller, ngTableParams) {
            $scope.service_url = PATHS.api_url;
            $rootScope.selectedBlog = "";
            $scope.visibilties = [];
            $scope.selectedVisibility = null;
            $scope.loggedInUserId = $cookieStore.get('userId');
            $scope.categories = [];
            $scope.subcategories = [];
            $scope.selectedOption = null;
            $scope.selectedCategory = "";
            $scope.category1 = null;
            $scope.selectedsubcategories = null;
            $scope.selectedSubCategory = "";
            $scope.selectedVisibility = null;
            $scope.blogs = [];

            $scope.title = "Blogs";
            usSpinnerService.spin('spinner-1');

            $http.get(PATHS.api_url + 'users/blogs/published').
            success(function (data) {
                $scope.blogs = data.data;
                // $scope.paging = data.meta.pagination;
                // $scope.totalPages = new Array(Number($scope.paging.total_pages));
                // //$scope.active = $scope.paging.current_page;
                // $scope.next = data.meta.next;
                usSpinnerService.stop('spinner-1');

                $scope.blogAdminTableParams = new ngTableParams({
                    page: 1,            // show first page
                    count: 10           // count per page
                }, {
                    total: $scope.blogs.length, // length of data
                    getData: function ($defer, params) {
                        $defer.resolve($scope.blogs.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                    }
                })


                $scope.EditBlog = function (blog) {
                    $location.path('/editblogs/' + blog.id);
                }

                function fetchBlogs() {
                    usSpinnerService.spin('spinner-1');
                    BlogService.getBlogs().then(function (data) {

                        usSpinnerService.stop('spinner-1');

                        $scope.blogs = data;
                    });
                }

                fetchBlogs();

                $scope.DeleteBlogDialog = function (id) {
                    var deleteBlogDialog = ngDialog.open(
                        {
                            template: 'deleteBlogTemplateId',
                            scope: $scope,
                            controller: $controller('deleteBlogCtrl', {
                                $scope: $scope,
                                blogId: id
                            })
                        });

                    deleteBlogDialog.closePromise.then(function (data) {

                        if (data.value.status) {
                            toastr.success(data.value.message, 'Blog deleted');
                            fetchBlogs();
                        }
                    });
                };

                // Show the dialog to set the options for show blog in evezplace
                //  Eg: evezplace section (product, service etc) and priority.
                $scope.showInEvezplaceDialog = function (blog) {

                    console.log('Click show in marketplace');
                    var showInEvezplaceDialog = ngDialog.open(
                        {
                            template: 'showInEvezplaceTemplateId',
                            scope: $scope,
                            controller: $controller('showBlogEvezplaceCtrl', {
                                $scope: $scope,
                                blog: blog
                            })
                        });

                    showInEvezplaceDialog.closePromise.then(function (data) {

                        fetchBlogs();

                        console.log(data);

                        if (data.value.status) {
                            toastr.success(data.value.message, 'Blog added to Marketplace section');
                        }
                    });

                }
            });
        });

evezownApp.controller('deleteBlogCtrl', function ($scope, BlogService, $cookieStore,
                                                  usSpinnerService, blogId, ngDialog) {
    console.log(blogId);

    // Delete blog item
    $scope.blogId = blogId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteBlog = function () {
        usSpinnerService.spin('spinner-1');
        BlogService.deleteBlog($scope.userId, $scope.blogId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close("", data);

        });
    }

    $scope.cancelDeleteBlog = function () {
        ngDialog.close();
    }
});

evezownApp.controller('showBlogEvezplaceCtrl', function ($scope, BlogService, EvezplaceHomeService, $cookieStore,
                                                         usSpinnerService, blog, ngDialog) {

    $scope.blogId = blog.id;
    $scope.userId = $cookieStore.get('userId');

    function getEvezplaceSection(userId) {
        EvezplaceHomeService.getSections(userId).
        then(function (data) {
            $scope.sections = data;
            $scope.selectedSectionId = $scope.sections[0].id;
        }, function (error) {
            toastr.error(error.error.message, 'Marketplace Sections');
        });
    }

    $scope.options = {
        priority: 0,
        selectedSectionId: 3,
        is_show_evezplace: false
    };

    if(blog.trending != null) {
        $scope.options.priority = parseInt(blog.trending.priority);
        $scope.options.selectedSectionId = blog.trending.evezown_section_id;
        $scope.options.is_show_evezplace = parseInt(blog.trending.is_show_evezplace);
    }

    getEvezplaceSection($scope.userId);

    $scope.addBlogShowEvezplace = function () {

        usSpinnerService.spin('spinner-1');
        BlogService.addBlogShowEvezplace($scope.userId, $scope.blogId, $scope.options).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close("", data);
        });
    };

    $scope.$watch('options.priority',function(val,old){
        console.log(val);
        $scope.options.priority = val;
    });

    $scope.cancelShowInEvezplaceBlog = function () {
        ngDialog.close();
    }
});
