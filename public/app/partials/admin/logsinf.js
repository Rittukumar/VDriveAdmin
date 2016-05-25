
'use strict';

evezownApp
    .controller('logsinf',
    function ($scope, $http, $routeParams,$location,PATHS, usSpinnerService,Session,$cookieStore,ngTableParams)
    {

        $scope.title = "Logs";
        $scope.publicpath = PATHS.api_url;
        $scope.userId = $cookieStore.get('userId')
        usSpinnerService.spin('spinner-1');
        $http.get(PATHS.api_url + 'admin/' + $cookieStore.get('userId') +'/logs').
            success(function(data)
            {   
                console.log(data);
                $scope.logs = data.logs;  
                $scope.files = data.files;
                $scope.current_file = data.current_file;              
                usSpinnerService.stop('spinner-1');

                $scope.logsAdminTableParams = new ngTableParams({
                    page: 1,            // show first page
                    count: 10           // count per page
                }, {
                    total: $scope.logs.length, // length of data
                    getData: function ($defer, params) {
                        $defer.resolve($scope.logs.slice((params.page() - 1) * params.count(), params.page() * params.count()));
                    }
                })
            });


    });