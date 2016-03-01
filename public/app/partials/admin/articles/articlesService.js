/**
 * Created by vishu on 20/08/15.
 */
evezownApp.factory('ArticleService', ['$http', '$q', 'PATHS' ,function ($http, $q, PATHS){

    ArticleService = {};

    ArticleService.getNews = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'admin/' + $userId + '/news')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving news');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.getHomeNews = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'news')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving news');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.getArticles = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'admin/' + $userId + '/articles')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving articles');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.getHomeArticles = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'articles')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving articles');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.getInterviews = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'admin/' + $userId + '/interviews')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving interviews');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.getHomeInterviews = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'interviews')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving interviews');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    // All vidoes to be shown to admin for moderation
    ArticleService.getVideos = function ($userId) {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'admin/' + $userId + '/videos')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving videos');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    // Top 4 videos to be shown on home page
    ArticleService.getTopVideos = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'videos/top')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving videos');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    // Videos to be shown on click of more videos on home page
    ArticleService.getMoreVideos = function () {
        var deferred = $q.defer();
        $http.get(PATHS.api_url +  'videos/more')
            .success(function(data){
                deferred.resolve(data.data);
            })
            .error(function(err){
                console.log('Error retrieving videos');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.createNews = function ($userId, $news) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/news/add', $news)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.createArticle = function ($userId, $article) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/article/add', $article)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.createInterview = function ($userId, $interview) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/interview/add', $interview)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.createVideo = function ($userId, $video) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/video/add', $video)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.updateNews = function ($userId, $news) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/news/update', $news)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.updateArticle = function ($userId, $article) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/article/update', $article)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.updateInterview = function ($userId, $interview) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/interview/update', $interview)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.updateVideo = function ($userId, $video) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/' + $userId + '/video/update', $video)
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.deleteNews = function ($userId, $newsId) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/news/delete', { user_id : $userId, news_id : $newsId})
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.deleteArticle = function ($userId, $articleId) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/article/delete', { user_id : $userId, article_id : $articleId})
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.deleteInterview = function ($userId, $interviewId) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/interview/delete', { user_id : $userId, interview_id : $interviewId})
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    ArticleService.deleteVideo = function ($userId, $videoId) {

        var deferred = $q.defer();
        $http.post(PATHS.api_url +  'admin/video/delete', { user_id : $userId, video_id : $videoId})
            .success(function(data){
                deferred.resolve(data);
            })
            .error(function(err){
                console.log('Error on saving');
                deferred.reject(err);
            });
        return deferred.promise;
    }

    return ArticleService;

}]);