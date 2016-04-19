/**
 * Created by Viswanathan on 6/18/2015.
 */
evezownApp
    .factory('EvezplaceHomeService', function ($http, $q, PATHS) {

        var EvezplaceHomeService = {};

        EvezplaceHomeService.getCategories = function (section_id) {
            return $http
                .get(PATHS.api_url + 'categories/' + section_id)
                .then(function (res) {
                    return res.data.data;
                });
        };

        EvezplaceHomeService.getSubcategories = function (category_id) {
            return $http
                .get(PATHS.api_url + 'subcategories/' + category_id)
                .then(function (res) {
                    return res.data.data;
                });
        };

        EvezplaceHomeService.getSections = function (userId) {
            console.log('admin user id ' + userId);
            var deferred = $q.defer();
            $http.get(PATHS.api_url + 'admin/' + userId + '/evezplace/sections')
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error retrieving promotion');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        EvezplaceHomeService.getPromotion = function (sectionId) {

            var deferred = $q.defer();
            $http.get(PATHS.api_url + 'evezplace/' + sectionId + '/promotion')
                .success(function (data) {
                    deferred.resolve(data.data);
                })
                .error(function (err) {
                    console.log('Error retrieving promotion');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        EvezplaceHomeService.savePromotion = function (userId, promotion, sectionId) {
            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/'
                    + sectionId + '/promotion', promotion)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error saving promotion details');
                    deferred.reject(err);
                });
            return deferred.promise;
        };


        EvezplaceHomeService.savePromotionImage = function (userId, imageName, promotionSection, sectionId) {

            var data = {imageName: imageName, promotion_section: promotionSection};
            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/' + sectionId + '/promotion/image/upload', data)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error uploading promotion image');
                    deferred.reject(err);
                });
            return deferred.promise;
        };



        EvezplaceHomeService.getRecommendations = function (sectionId, page) {

            var deferred = $q.defer();
            $http.get(PATHS.api_url + 'evezplace/' + sectionId + '/recommendations?page=' + page)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error retrieving recommendations');
                    deferred.reject(err);
                });
            return deferred.promise;
        };



        EvezplaceHomeService.saveRecommendationDetails = function (userId, recommendation, sectionId) {
            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/'
                    + sectionId + '/recommendation', recommendation)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error saving promotion details');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        EvezplaceHomeService.DeleteRecommendationDetails = function (userId, recommendation) {
            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/deleteRecommendation', recommendation)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error deleting details');
                    deferred.reject(err);
                });
            return deferred.promise;
        };


        EvezplaceHomeService.saveRecommendationImage = function (userId, imageName, recommendationId ,sectionId) {

            console.log('Recommendation id: ' + recommendationId);

            var data = {imageName: imageName, id : recommendationId};

            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/' + sectionId + '/recommendation/image/upload', data)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error uploading recommendation image');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        EvezplaceHomeService.getRecommendation = function (recommendationid) {

            var deferred = $q.defer();
            $http.get(PATHS.api_url + 'admin/evezplace/recommendations/' + recommendationid)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error retrieving recommendations');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        /* Trending items section */
        EvezplaceHomeService.getTrendingItems = function (sectionId, page) {

            var deferred = $q.defer();
            $http.get(PATHS.api_url + 'evezplace/' + sectionId + '/trending/items?page=' + page)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error retrieving recommendations');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        EvezplaceHomeService.saveTrendingItemDetails = function (userId, trendingItem, sectionId) {
            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/'
                    + sectionId + '/trending/item', trendingItem)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error saving trending item details');
                    deferred.reject(err);
                });
            return deferred.promise;
        };


        EvezplaceHomeService.DeleteTrendingItemDetails = function (userId, trendingItem) {
            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/deleteTrendingItem', trendingItem)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error Deleting trending item details');
                    deferred.reject(err);
                });
            return deferred.promise;
        };


        EvezplaceHomeService.saveTrendingItemImage = function (userId, imageName, trendingItemId ,sectionId) {

            console.log('Trending Item Id: ' + trendingItemId);

            var data = {imageName: imageName, id : trendingItemId};

            var deferred = $q.defer();
            $http.post(PATHS.api_url + 'admins/' + userId + '/evezplace/' + sectionId + '/trending/item/image/upload', data)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error uploading trending item image');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        EvezplaceHomeService.getTrendingItem = function (trendingItemId) {

            var deferred = $q.defer();
            $http.get(PATHS.api_url + 'admin/evezplace/trending/items/' + trendingItemId)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (err) {
                    console.log('Error retrieving trending items');
                    deferred.reject(err);
                });
            return deferred.promise;
        };

        return EvezplaceHomeService;
    });