
'use strict';

evezownApp.controller('adminScreenCtrl',
    function ($scope, $http, $routeParams, $cookieStore, PATHS, usSpinnerService,Session)
    {

        
    $scope.title = "Site Content Conrol";
    $scope.allscreens = [];
    $scope.captions = [];
    $scope.showTable = false;

	//get all the screens
    $scope.GetAllScreens = function()
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') +'/allscreens').
            success(function (data, status, headers, config)
            {
                console.log(data.data);
                $scope.allscreens = data.data;
                $scope.Screen = data.data[0];
                $scope.GetCaptions($scope.Screen.id);
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.GetAllScreens();

    //get all the captions based on the screen
    $scope.GetCaptions = function()
    {


    	$http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/'+ $scope.Screen.id +'/getscreenfields').
            success(function (data, status, headers, config)
            {
                console.log(data);
                $scope.captions = data.data;
            }).error(function (data)
            {
                console.log(data);
            });

        $scope.showTable = true;


    }


    $scope.SaveChanges = function()
    {
    	console.log($scope.captions);
    	$http.post(PATHS.api_url + 'admin/'+ $cookieStore.get('userId')  +'/saveScreenFields'
            , {
                data: {
                    screenFields: $scope.captions
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