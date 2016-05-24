
'use strict';

evezownApp.controller('adminConfigurationCtrl',
    function ($scope, $http, $routeParams, $cookieStore, PATHS, usSpinnerService,Session)
    {

        
    $scope.title = "Manage Configurations";
    $scope.allConfigurations = [];

	//get all the configuration items
    $scope.GetAllConfigurations = function()
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') +'/allConfigurations').
            success(function (data, status, headers, config)
            {
                console.log(data.data);
                $scope.allConfigurations = data.data;
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.GetAllConfigurations();


    $scope.SaveChanges = function()
    {
    	$http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/ConfigureDatas'
            , {
                data: {
                    ConfigurationDatas: $scope.allConfigurations
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function(data){
                console.log(data);
                toastr.success(data.message);   
            }).error(function (data) {
                console.log(data);
                 toastr.error(data.error.message);
            });
    };
 
    });