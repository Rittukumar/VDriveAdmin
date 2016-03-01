
'use strict';

evezownApp
    .controller('opportunitiesCntr',
    function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService,Session)
    {

        $scope.title = "opportunities";
        usSpinnerService.spin('spinner-1');
       $http.get(PATHS.api_url + 'users/blogs/published').
            success(function(data)
            {
                $scope.opportunities = data.data;
                $scope.paging = data.meta.pagination;
                $scope.totalPages = new Array(Number($scope.paging.total_pages));
                $scope.active = $scope.paging.current_page;
                $scope.next = data.meta.next;
                usSpinnerService.stop('spinner-1');
            });
    });