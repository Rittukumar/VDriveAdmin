
'use strict';

evezownApp
    .controller('woiceinf',
    function ($scope, $http, $routeParams,$location,PATHS, usSpinnerService,Session,$cookieStore,ngTableParams)
    {

        $scope.title = "Posts";
        usSpinnerService.spin('spinner-1');
       $http.get(PATHS.api_url + 'admin/' + $cookieStore.get('userId') +'/posts/all').
            success(function(data)
            {
                $scope.posts = data.data;
                // $scope.paging = data.meta.pagination;
                // $scope.totalPages = new Array(Number($scope.paging.total_pages));
                // $scope.active = $scope.paging.current_page;
                // $scope.next = data.meta.next;
                usSpinnerService.stop('spinner-1');


        $scope.woiceAdminTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: $scope.posts.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.posts.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })
            });

    });