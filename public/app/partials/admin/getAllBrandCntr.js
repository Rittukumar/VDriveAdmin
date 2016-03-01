
'use strict';
evezownApp
    .controller('getAllBrandCntr',
    function AdminUsers($scope, $http, $routeParams, PATHS, usSpinnerService,Session,$cookieStore)
    {

        $scope.title = "Brands";
        usSpinnerService.spin('spinner-1');
          $http.get(PATHS.api_url + 'admin/' + $cookieStore.get('userId') +'/brands/all'). 
            success(function(data)
            {
                $scope.brands = data.data;
                // $scope.paging = data.meta.pagination;
                // $scope.totalPages = new Array(Number($scope.paging.total_pages));
                // $scope.active = $scope.paging.current_page;
                // $scope.next = data.meta.next;
                usSpinnerService.stop('spinner-1');

              
            });

            

    });










