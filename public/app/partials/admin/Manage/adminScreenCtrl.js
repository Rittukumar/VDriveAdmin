
'use strict';

evezownApp.controller('adminScreenCtrl',
    function ($scope, $http, $routeParams, $cookieStore, PATHS, usSpinnerService,Session)
    {

        
    $scope.title = "Screens";
    $scope.allscreens = [];
    $scope.captions = [];
    $scope.showTable = false;

 //    $scope.items = [{
	//   id: 1,
	//   label: 'LandingPage'
	// }, {
	//   id: 2,
	//   label: 'Blogs'
	// }, {
	//   id: 3,
	//   label: 'articles'
	// }, {
	//   id: 4,
	//   label: 'events'
	// }];


	//get all the screens
    $scope.GetAllScreens = function()
    {
        $http.get(PATHS.api_url + 'admin/'+ $cookieStore.get('userId') +'/allscreens').
            success(function (data, status, headers, config)
            {
                console.log(data.data);
                $scope.allscreens = data.data;
            }).error(function (data)
            {
                console.log(data);
            });
    }

    $scope.GetAllScreens();

    //get all the captions based on the screen
    $scope.GetCaptions = function($screen)
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


   //      if($scope.Screen.id == 1)
   //      {
   //      	$scope.captions = [{
			//   id: 1,
			//   label: 'mysite',
			//   description: 'Description1'
			// }, {
			//   id: 2,
			//   label: 'marketplace',
			//   description: 'Description1'
			// }, {
			//   id: 3,
			//   label: 'jobs',
			//   description: 'Description1'
			// }, {
			//   id: 4,
			//   label: 'stores',
			//   description: 'Description1'
			// }];
   //      }

   //      if($scope.Screen.id == 2)
   //      {
   //      	$scope.captions = [{
			//   id: 1,
			//   label: 'mysite2',
			//   description: 'Description2'
			// }, {
			//   id: 2,
			//   label: 'marketplace2',
			//   description: 'Description2'
			// }, {
			//   id: 3,
			//   label: 'jobs2',
			//   description: 'Description2'
			// }, {
			//   id: 4,
			//   label: 'stores2',
			//   description: 'Description2'
			// }];
   //      }

   //      if($scope.Screen.id == 3)
   //      {
   //      	$scope.captions = [{
			//   id: 1,
			//   label: 'mysite3',
			//   description: 'Description3'
			// }, {
			//   id: 2,
			//   label: 'marketplace3',
			//   description: 'Description3'
			// }, {
			//   id: 3,
			//   label: 'jobs3',
			//   description: 'Description3'
			// }, {
			//   id: 4,
			//   label: 'stores3',
			//   description: 'Description3'
			// }];
   //      }
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