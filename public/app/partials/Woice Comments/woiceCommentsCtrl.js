'use strict';


evezownApp.controller('woiceCommentsCtrl', function($scope,$cookieStore,PATHS,$http,$rootScope,Lightbox)
{

    if(!$cookieStore.get('api_key'))
    {
        $location.path('/login');
    }
    $scope.imagePath = PATHS.api_url;
    $scope.comments = [];
    $rootScope.commentsCount = 0;
    $rootScope.myGrade = 0;
    $scope.post = [];
    $scope.loggedInUser = $cookieStore.get('userId');
    
    $scope.GetPost = function (postId)
    {
        $scope.url = PATHS.api_url + 'posts/post/'+ postId;
        $http.get($scope.url).
            success(function (data)
            {
                $scope.post = data.data;
                $scope.GetComments();
            })
    }
    if($cookieStore.get('postId'))
    {
        var postId = $cookieStore.get('postId');
        $scope.GetPost(postId);
    }


    //http://creativethoughts.co.in/evezown/api/public/v1/posts/{post_id}/comments



    $scope.GetComments = function ()
    {
        $scope.url = PATHS.api_url + 'posts/'+ $scope.post.id+'/comments';
        $http.get($scope.url).
            success(function (data)
            {
                $rootScope.commentsCount = data.length;
                $scope.comments = data;
            })
    }



    $scope.CreateComment = function ()
    {
        if(!$scope.addedcomment)
        {
            toastr.error("Please enter comment",'Stream It');
        }
        else
        {
            $http.post(PATHS.api_url + 'posts/'+ $scope.post.id+'/comments/create'
            , {
                data: {
                    owner_id: $cookieStore.get('userId'),
                    comment: $scope.addedcomment,
                    post_id: $scope.post.id
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.addedcomment = '';
                $scope.GetComments();
                toastr.success(data.message, 'Woice');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Woice');
            });
        }
    }

    $scope.DeleteClick = function (comment)
    {
        //http://creativethoughts.co.in/evezown/api/public/v1/posts/{post_id}/comments/{comment_id}/delete
        $http.post(PATHS.api_url + 'posts/'+ $scope.post.id+'/comments/'+comment.id+'/delete'
            , {
                data:
                {

                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                $scope.GetComments();
                toastr.success(data.message, 'Woice');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Woice');
            });
    }

    $scope.GetLevelsByUserId = function(post)
    {
        var grades = post.grades;
        var myGrade = 0;
        angular.forEach(grades, function(value, key)
            {
                if(value.owner_id == $cookieStore.get('userId'))
                {
                    myGrade =  value.scale;
                }
            },
            grades);
        return myGrade;
    }



    $scope.AddRewoice = function(post)
    {
        $http.post(PATHS.api_url + 'users/'+$cookieStore.get('userId')+'/posts/'+post.id+'/rewoice'
            , {
                data: {

                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                var postId = $cookieStore.get('postId');
                $scope.GetPost(postId);
                toastr.success(data.message, 'Woice');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Woice');
            });
    }

    $scope.UpdateLevels = function(stars,post)
    {
        $http.post(PATHS.api_url + 'posts/'+ post.id+'/grades/create'
            , {
                data: {
                    owner_id: $cookieStore.get('userId'),
                    scale: stars,
                    post_id: post.id
                },
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).
            success(function (data, status, headers, config)
            {
                var postId = $cookieStore.get('postId');
                $scope.GetPost(postId);
                toastr.success(data.message, 'Woice');

            }).error(function (data)
            {
                toastr.error(data.error.message, 'Woice');
            });
    }

    $scope.openLightBox = function(images,index)
    {
        $scope.imagesitems = [];
        angular.forEach(images, function(value, key)
            {
                $scope.imagesitems.push(value.large_image_url);
            },
            $scope.imagesitems);
        Lightbox.baseURI = '';
        Lightbox.openModal($scope.imagesitems, index);
    }

});