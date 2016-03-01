/**
 * Created by vishu on 20/08/15.
 */
evezownApp
    .controller('articlesCtrl', function ($scope, ArticleService, $controller,
                                          $cookieStore, usSpinnerService, ngTableParams, ngDialog) {

        $scope.news = [];
        $scope.articles = [];
        $scope.interviews = [];
        $scope.videos = [];
        $scope.addNews = {};
        $scope.addArticle = {};
        $scope.addInterview = {};

        $scope.userId = $cookieStore.get('userId');

        // Fetch all news items
        function fetchNews(userID) {
            usSpinnerService.spin('spinner-1');
            ArticleService.getNews(userID).then(function (data) {

                usSpinnerService.stop('spinner-1');

                $scope.news = data;
            });
        }

        // Fetch all article items.
        function fetchArticles(userID) {
            usSpinnerService.spin('spinner-1');
            ArticleService.getArticles(userID).then(function (data) {

                usSpinnerService.stop('spinner-1');

                $scope.articles = data;
            });
        }

        // Fetch all interview items.
        function fetchInterviews(userID) {
            usSpinnerService.spin('spinner-1');
            ArticleService.getInterviews(userID).then(function (data) {

                usSpinnerService.stop('spinner-1');

                $scope.interviews = data;
            });
        }

        // Fetch all video items.
        function fetchVideos(userID) {
            usSpinnerService.spin('spinner-1');
            ArticleService.getVideos(userID).then(function (data) {

                usSpinnerService.stop('spinner-1');

                $scope.videos = data;
            });
        }

        // Create news item
        $scope.createNews = function (addNews) {
            usSpinnerService.spin('spinner-1');
            ArticleService.createNews($scope.userId, addNews).then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close();
                toastr.success(data.message, 'News item added successfully');
            });
        }

        // Create news item
        $scope.createArticle = function (addArticle) {
            usSpinnerService.spin('spinner-1');
            ArticleService.createArticle($scope.userId, addArticle).then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close();
                toastr.success(data.message, 'Article added successfully');
            });
        }

        // Create news item
        $scope.createInterview = function (addInterview) {
            usSpinnerService.spin('spinner-1');
            ArticleService.createInterview($scope.userId, addInterview).then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close();
                toastr.success(data.message, 'Interview added successfully');
            });
        }

        // Create news item
        $scope.createVideo = function (addVideo) {
            usSpinnerService.spin('spinner-1');
            ArticleService.createVideo($scope.userId, addVideo).then(function (data) {
                usSpinnerService.stop('spinner-1');
                ngDialog.close();
                toastr.success(data.message, 'Video added successfully');
            });
        }



        fetchNews($scope.userId);
        fetchArticles($scope.userId);
        fetchInterviews($scope.userId);
        fetchVideos($scope.userId);

        // News table param for News table
        $scope.newsTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: $scope.news.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.news.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })

        //
        $scope.articlesTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: $scope.articles.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.articles.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })

        //
        $scope.interviewsTableParams = new ngTableParams({
            page: 1,            // show first page
            count: 10           // count per page
        }, {
            total: $scope.interviews.length, // length of data
            getData: function ($defer, params) {
                $defer.resolve($scope.interviews.slice((params.page() - 1) * params.count(), params.page() * params.count()));
            }
        })


        $scope.openUrl = function(url){
            $window.open(url);   // may alse try $window
        }

        $scope.CreateNewsDialog = function()
        {
            var addNewsDialog = ngDialog.open({ template: 'addNewsTemplateId' });

            addNewsDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchNews($scope.userId);
            });
        }

        $scope.CreateArticleDialog = function()
        {
            var addArticleDialog = ngDialog.open({ template: 'addArticleTemplateId' });

            addArticleDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchArticles($scope.userId);
            });
        }

        $scope.CreateInterviewDialog = function()
        {
            var addInterviewDialog = ngDialog.open({ template: 'addInterviewTemplateId' });

            addInterviewDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchInterviews($scope.userId);
            });
        }

        $scope.CreateVideoDialog = function()
        {
            var addVideoDialog = ngDialog.open({ template: 'addVideoTemplateId' });

            addVideoDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchVideos($scope.userId);
            });
        }

        $scope.UpdateNewsDialog = function(newsItem)
        {
            var updateNewsDialog = ngDialog.open(
                {
                    template: 'updateNewsTemplateId',
                    scope: $scope,
                    controller: $controller('updateNewsCtrl', {
                        $scope: $scope,
                        newsItem: newsItem
                    })
                });

            updateNewsDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchNews($scope.userId);
            });
        }

        $scope.UpdateArticleDialog = function(articleItem)
        {
            var updateArticleDialog = ngDialog.open(
                {
                    template: 'updateArticleTemplateId',
                    scope: $scope,
                    controller: $controller('updateArticleCtrl', {
                        $scope: $scope,
                        articleItem: articleItem
                    })
                });

            updateArticleDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchArticles($scope.userId);
            });
        }

        $scope.UpdateInterviewDialog = function(interviewItem)
        {
            var updateInterviewDialog = ngDialog.open(
                {
                    template: 'updateInterviewTemplateId',
                    scope: $scope,
                    controller: $controller('updateInterviewCtrl', {
                        $scope: $scope,
                        interviewItem: interviewItem
                    })
                });

            updateInterviewDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchInterviews($scope.userId);
            });
        }

        $scope.UpdateVideoDialog = function(videoItem)
        {
            var updateVideoDialog = ngDialog.open(
                {
                    template: 'updateVideoTemplateId',
                    scope: $scope,
                    controller: $controller('updateVideoCtrl', {
                        $scope: $scope,
                        videoItem: videoItem
                    })
                });

            updateVideoDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchVideos($scope.userId);
            });
        }

        $scope.DeleteNewsDialog = function(id)
        {
            var deleteNewsDialog = ngDialog.open(
                {
                    template: 'deleteNewsTemplateId',
                    scope: $scope,
                    controller: $controller('deleteNewsCtrl', {
                        $scope: $scope,
                        newsId: id
                    })
                });

            deleteNewsDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchNews($scope.userId);
            });
        }

        $scope.DeleteArticleDialog = function(id)
        {
            var deleteArticleDialog = ngDialog.open(
                {
                    template: 'deleteArticleTemplateId',
                    scope: $scope,
                    controller: $controller('deleteArticleCtrl', {
                        $scope: $scope,
                        articleId: id
                    })
                });

            deleteArticleDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchArticles($scope.userId);
            });
        }

        $scope.DeleteInterviewDialog = function(id)
        {
            var deleteInterviewDialog = ngDialog.open(
                {
                    template: 'deleteInterviewTemplateId',
                    scope: $scope,
                    controller: $controller('deleteInterviewCtrl', {
                        $scope: $scope,
                        interviewId: id
                    })
                });

            deleteInterviewDialog.closePromise.then(function (data) {
                console.log(data.id + ' has been dismissed.');
                fetchInterviews($scope.userId);
            });
        }

        $scope.DeleteVideoDialog = function(id)
        {
            var deleteVideoDialog = ngDialog.open(
                {
                    template: 'deleteVideoTemplateId',
                    scope: $scope,
                    controller: $controller('deleteVideoCtrl', {
                        $scope: $scope,
                        videoId: id
                    })
                });

            deleteVideoDialog.closePromise.then(function (data) {

                if(data.value.status)
                    fetchVideos($scope.userId);
            });
        }

        $scope.updateNewsPriority = function(newsItem) {
            // Update news item
            usSpinnerService.spin('spinner-1');
            $scope.newsItem = newsItem;
            $scope.userId = $cookieStore.get('userId');

            ArticleService.updateNews($scope.userId, $scope.newsItem).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'News item updated successfully');
            });
        }

        $scope.updateArticlePriority = function(articleItem) {
            // Update article item
            usSpinnerService.spin('spinner-1');
            $scope.articleItem = articleItem;
            $scope.userId = $cookieStore.get('userId');

            ArticleService.updateArticle($scope.userId, $scope.articleItem).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Article updated successfully');
            });
        }

        $scope.updateInterviewPriority = function(interviewItem) {
            // Update interview item
            usSpinnerService.spin('spinner-1');
            $scope.interviewItem = interviewItem;
            $scope.userId = $cookieStore.get('userId');

            ArticleService.updateArticle($scope.userId, $scope.interviewItem).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Interview updated successfully');
            });
        }

        $scope.updateVideoPriority = function(videoItem) {
            // Update Video item
            usSpinnerService.spin('spinner-1');
            $scope.videoItem = videoItem;
            $scope.userId = $cookieStore.get('userId');

            ArticleService.updateVideo($scope.userId, $scope.videoItem).then(function (data) {
                usSpinnerService.stop('spinner-1');
                toastr.success(data.message, 'Video updated successfully');
            });
        }
    });

evezownApp.controller('deleteNewsCtrl', function($scope, ArticleService, $cookieStore, usSpinnerService, newsId, ngDialog) {
    console.log(newsId);

    // Delete news item
    $scope.newsId = newsId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteNews = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.deleteNews($scope.userId, $scope.newsId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'News item deleted successfully');
        });
    }

    $scope.cancelDeleteNews = function() {
        ngDialog.close();
    }
});

evezownApp.controller('deleteArticleCtrl', function($scope, ArticleService, $cookieStore,
                                                        usSpinnerService, articleId, ngDialog) {
    console.log(articleId);

    // Delete news item
    $scope.articleId = articleId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteArticle = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.deleteArticle($scope.userId, $scope.articleId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'Article deleted successfully');
        });
    }

    $scope.cancelDeleteArticle = function() {
        ngDialog.close();
    }
});

evezownApp.controller('deleteInterviewCtrl', function($scope, ArticleService, $cookieStore,
                                                        usSpinnerService, interviewId, ngDialog) {
    console.log(interviewId);

    // Delete news item
    $scope.interviewId = interviewId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteInterview = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.deleteInterview($scope.userId, $scope.interviewId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'Interview deleted successfully');
        });
    }

    $scope.cancelDeleteInterview = function() {
        ngDialog.close();
    }
});

evezownApp.controller('deleteVideoCtrl', function($scope, ArticleService, $cookieStore,
                                                        usSpinnerService, videoId, ngDialog) {
    console.log(videoId);

    // Delete news item
    $scope.videoId = videoId;
    $scope.userId = $cookieStore.get('userId');
    $scope.deleteVideo = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.deleteVideo($scope.userId, $scope.videoId).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close("", data);
            toastr.success(data.message, 'Video deleted successfully');
        });
    }

    $scope.cancelDeleteVideo = function() {
        ngDialog.close();
    }
});

evezownApp.controller('updateNewsCtrl', function($scope, ArticleService, $cookieStore,
                                                    usSpinnerService, newsItem, ngDialog) {
    // Update news item
    $scope.newsItem = newsItem;
    $scope.userId = $cookieStore.get('userId');
    $scope.updateNews = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.updateNews($scope.userId, $scope.newsItem).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'News item updated successfully');
        });
    }

});

evezownApp.controller('updateArticleCtrl', function($scope, ArticleService, $cookieStore,
                                                    usSpinnerService, articleItem, ngDialog) {
    // Update news item
    $scope.articleItem = articleItem;
    $scope.userId = $cookieStore.get('userId');
    $scope.updateArticle = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.updateArticle($scope.userId, $scope.articleItem).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'Article updated successfully');
        });
    }

});

evezownApp.controller('updateInterviewCtrl', function($scope, ArticleService, $cookieStore,
                                                    usSpinnerService, interviewItem, ngDialog) {
    // Update news item
    $scope.interviewItem = interviewItem;
    $scope.userId = $cookieStore.get('userId');
    $scope.updateInterview = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.updateInterview($scope.userId, $scope.interviewItem).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'Interview updated successfully');
        });
    }

});

evezownApp.controller('updateVideoCtrl', function($scope, ArticleService, $cookieStore,
                                                    usSpinnerService, videoItem, ngDialog) {
    // Update news item
    $scope.videoItem = videoItem;
    $scope.userId = $cookieStore.get('userId');
    $scope.updateVideo = function () {
        usSpinnerService.spin('spinner-1');
        ArticleService.updateVideo($scope.userId, $scope.videoItem).then(function (data) {
            usSpinnerService.stop('spinner-1');
            ngDialog.close();
            toastr.success(data.message, 'Video updated successfully');
        });
    }
});