<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

use Intervention\Image\Facades\Image;

Route::get('/', function () {
    return View::make('hello');
});
 
Route::post('paymentstatus/paymentstatus', function () {
 	$inputArray = Input::all();
	return View::make('paymentstatus')->with('data',$inputArray);
}); 

Route::get('payupaymentsuccess/payupaymentsuccess', function () {
	return View::make('payupaymentsuccess');
});

Route::group(array('prefix' => 'v1'), function () {

	
    Route::get('mail/send', 'AdminController@sendMail');
    Route::get('admin/{admin_id}/users', 'AdminController@getUsers');
    Route::get('admin/{admin_id}/evezplace/sections', 'AdminController@getEvezplaceSections');
    Route::get('admin/{admin_id}/Allusers', 'AdminController@getAllUsers');
    Route::get('admin/{admin_id}/invites', 'AdminController@getInvites');
    Route::post('admin/{admin_id}/invite/{id}/accept', 'AdminController@acceptInvite');
    Route::post('admin/{admin_id}/invite/{id}/reject', 'AdminController@rejectInvite');
    Route::get('admin/{admin_id}/posts/all', 'AdminController@getPostForAdmin');
    Route::get('admin/{admin_id}/brands/all', 'AdminController@getBrandsForAdmin');
    Route::post('admin/{admin_id}/brand/add', 'AdminController@addBrand');
    // Route::post('admin/{admin_id}/users/groups/'+group.id+'/delete', 'AdminController@DeleteGroup');
    Route::post('admin/{admin_id}/users/groups/update', 'AdminController@EditGroup');
    Route::post('admin/{admin_id}/users/groups/update', 'AdminController@UpdateGroup');
    Route::get('admin/{admin_id}/users/{user_id}/personal_info', 'AdminController@getPersonalInfo');
    Route::post('admin/{admin_id}/users/personal_info/save', 'AdminController@savePersonalInfo');
    Route::post('admin/{admin_id}/users/add_new_user', 'UsersController@createNewUser');


    // News, articles, interviews
    Route::get('admin/{admin_id}/news', 'AdminController@getNews');
    Route::get('news', 'AdminController@getHomeNews');
    Route::get('admin/{admin_id}/articles', 'AdminController@getArticles');
    Route::get('articles', 'AdminController@getHomeArticles');
    Route::get('admin/{admin_id}/interviews', 'AdminController@getInterviews');
    Route::get('admin/{admin_id}/videos', 'AdminController@getVideos');
    Route::get('interviews', 'AdminController@getHomeInterviews');
    Route::post('admin/{admin_id}/news/add', 'AdminController@createNews');
    Route::post('admin/{admin_id}/news/update', 'AdminController@updateNews');
    Route::post('admin/{admin_id}/article/update', 'AdminController@updateArticle');
    Route::post('admin/{admin_id}/interview/update', 'AdminController@updateInterview');
    Route::post('admin/news/delete', 'AdminController@deleteNews');
    Route::post('admin/article/delete', 'AdminController@deleteArticle');
    Route::post('admin/interview/delete', 'AdminController@deleteInterview');
    Route::post('admin/video/delete', 'AdminController@deleteVideo');
    Route::post('admin/{admin_id}/article/add', 'AdminController@createArticle');
    Route::post('admin/{admin_id}/interview/add', 'AdminController@createInterview');
    Route::post('admin/{admin_id}/video/add', 'AdminController@createVideo');
    Route::post('admin/{admin_id}/video/update', 'AdminController@updateVideo');
    Route::get('videos/top', 'AdminController@getTopVideos');
    Route::get('videos/more', 'AdminController@getMoreVideos');

    Route::post('admin/{admin_id}/users/userAction', 'AdminController@userAction');
    
    //Creating a post URL for order success.
   Route::post('order/success/posturl', 'OrderController@orderSuccess');

    // Eveplace promotion section
    Route::get('evezplace/{section_id}/promotion', 'AdminEvezplacePromotionController@index');
    Route::post('admins/{user_id}/evezplace/{section_id}/promotion', 'AdminEvezplacePromotionController@store');
    Route::post('admins/{user_id}/evezplace/{section_id}/promotion/image/upload', 'AdminEvezplacePromotionController@updatePromotionImage');

    // Evezplace recommendations section
    Route::get('evezplace/{section_id}/recommendations', 'EvezplaceRecommendationController@index');
    Route::post('admins/{user_id}/evezplace/{section_id}/recommendation', 'EvezplaceRecommendationController@store');
    Route::get('admin/evezplace/recommendations/{id}', 'EvezplaceRecommendationController@show');
    Route::post('admins/{user_id}/evezplace/{section_id}/recommendation/image/upload', 'EvezplaceRecommendationController@updateRecommendationImage');

    // Evezplace trending items section
    Route::get('evezplace/{section_id}/trending/items', 'EvezplaceTrendingController@index');
    Route::post('admins/{user_id}/evezplace/{section_id}/trending/item', 'EvezplaceTrendingController@store');
    Route::get('admin/evezplace/trending/items/{id}', 'EvezplaceTrendingController@show');
    Route::post('admins/{user_id}/evezplace/{section_id}/trending/item/image/upload', 'EvezplaceTrendingController@updateTrendingItemImage');

    // Evezplace trending blogs section
    Route::get('evezplace/{section_id}/trending/blogs', 'EvezplaceTrendingController@getTrendingBlogs');
    Route::post('admins/{user_id}/blogs/{blog_id}/add/trending', 'EvezplaceTrendingController@updateTrendingBlog');

    // Evezplace trending events section
    Route::get('evezplace/{section_id}/trending/events', 'EvezplaceTrendingController@getTrendingEvents');
    Route::post('admins/{user_id}/events/{event_id}/add/trending', 'EvezplaceTrendingController@updateTrendingEvent');

    //Eveplace trending forums section
    Route::get('evezplace/{section_id}/trending/forums', 'EvezplaceTrendingController@getTrendingForums');
    Route::post('admins/{user_id}/forums/{forum_id}/add/trending', 'EvezplaceTrendingController@updateTrendingForum');

    // Confide routes
    Route::post('users/members/search', 'UsersController@searchMembers');
    Route::get('users/{user_id}', 'UsersController@show');
    Route::post('users/get', 'UsersController@getUserDetailsByApiKey');
    Route::post('login', 'UsersController@doLogin');
    Route::post('signup', 'UsersController@store');
    Route::get('users/confirm/{code}', 'UsersController@confirm');
    Route::post('forgotPassword/email', 'UsersController@ForgotPassword');
    Route::post('resetPassword/user', 'UsersController@ResetPassword');
    Route::post('change_password/user', 'UsersController@ChangePassword');
    Route::post('users/forgot_password', 'UsersController@doForgotPassword');
    Route::post('users/reset_password', 'UsersController@doResetPassword');
    Route::get('users/logout', 'UsersController@logout');
    Route::post('users/{id}/aboutme', 'UsersController@updateAboutMe');
    Route::get('users/{id}/profile_image/current', 'UsersController@getCurrentProfilePic');
    Route::get('users/{id}/bottom_image/current', 'UsersController@getBottomProfilePic');
    Route::get('users/{id}/left_image/current', 'UsersController@getLeftProfilePic');
    Route::get('users/{id}/right_image/current', 'UsersController@getRightProfilePic');
    Route::get('users/{id}/profile_image/all', 'UsersController@getAllProfilePics');
    Route::post('users/profile_image/update', 'UsersController@updateProfilePic');
    Route::post('users/left_cover_image/update', 'UsersController@updateLeftCoverPic');
    Route::post('users/right_cover_image/update', 'UsersController@updateRightCoverPic');
    Route::post('users/bottom_cover_image/update', 'UsersController@updateBottomCoverPic');
    Route::get('users/{user_id}/invites', 'UsersController@inviteHistory');

    // User details routes
    Route::get('users/{user_id}/personal_info', 'UserDetailsController@getPersonalInfo');
    Route::post('users/personal_info/save', 'UserDetailsController@savePersonalInfo');
    Route::get('users/{user_id}/enhanced_profile', 'UserDetailsController@getEnhancedProfile');
    Route::post('users/enhanced_profile/save', 'UserDetailsController@saveEnhancedProfile');
    Route::get('users/{user_id}/online_profile', 'UserDetailsController@getOnlineProfile');
    Route::post('users/online_profile/save', 'UserDetailsController@saveOnlineProfile');
    Route::get('users/{user_id}/reference_profile', 'UserDetailsController@getReferenceProfile');
    Route::post('users/reference_profile/save', 'UserDetailsController@saveReferenceProfile');
    Route::get('users/{user_id}/participation_profile', 'UserDetailsController@getParticipationProfile');
    Route::post('users/interest_profile/save', 'UserDetailsController@saveInterestInfo');
    Route::get('users/{user_id}/interest_profile', 'UserDetailsController@getInterestInfo');
    Route::get('users/{user_id}/other_services_profile', 'UserDetailsController@getOtherServicesProfile');
    Route::get('users/{user_id}/partnering_profile', 'UserDetailsController@getPartneringProfile');
    Route::post('users/participation_profile/save', 'UserDetailsController@saveParticipationProfile');
    Route::post('users/other_services_profile/save', 'UserDetailsController@saveOtherServicesProfile');
    Route::post('users/partnering_profile/save', 'UserDetailsController@savePartneringProfile');

    Route::get('users/{user_id}/feedback', 'UserDetailsController@getFeedbackProfile');
    Route::post('users/feedback/save', 'UserDetailsController@saveFeedbackProfile');
    //savePartneringProfile
    //getPartneringProfile
    Route::get('posttypes', 'HomeController@getPostTypes');
    Route::get('tags/{keyword}', 'HomeController@getAllTags');

    // Woice controller actions.
    Route::get('categories/{section_id}', 'WoiceController@getCategories');
    Route::get('category/{cat_id}', 'WoiceController@getCategoriesById');
    Route::get('subcategory/{sub_cat_id}', 'WoiceController@getSubcategoryById');
    //categories/get/all
    Route::get('categories/get/all', 'WoiceController@getAllCategories');
    Route::get('subcategories/{category_id}', 'WoiceController@getSubcategories');
    Route::post('brands/add', 'WoiceController@addBrand');
    Route::get('brands/{sub_cat_id}', 'WoiceController@getBrands');
    Route::get('brands/{sub_cat_id}/find/{search_key}', 'WoiceController@findBrands');
    Route::get('visibility', 'WoiceController@getVisibility');
    Route::get('posts/{user_id}', 'WoiceController@getPosts');
    Route::get('posts/recco/{user_id}', 'WoiceController@getRecco');
    Route::get('posts/woice/{user_id}', 'WoiceController@getWoice');
    Route::get('posts/post/{post_id}', 'WoiceController@getPost');
    Route::post('users/{user_id}/posts', 'WoiceController@getMyPosts');
    Route::get('posts/{user_id}/type/{post_type_id}', 'WoiceController@getPostsByType');
    Route::post('posts/post/search', 'WoiceController@searchPost');

    Route::post('posts/{post_id}/priority/update', 'WoiceController@updatePostPriority');

    //searchPost()
    Route::get('deletePost/{woice_id}', 'WoiceController@deletePost');
    Route::post('updatePost', 'WoiceController@updatePost');
    Route::post('users/{user_id}/post/create', 'WoiceController@createPost');
    Route::post('users/{user_id}/posts/{post_id}/rewoice', 'WoiceController@createRewoicePost');

    // Woice comments controller
    Route::get('posts/{post_id}/comments', 'WoiceCommentsController@show');
    Route::post('posts/{post_id}/comments/create', 'WoiceCommentsController@store');
    Route::post('posts/{post_id}/comments/{comment_id}/update', 'WoiceCommentsController@update');
    Route::post('posts/{post_id}/comments/{comment_id}/delete', 'WoiceCommentsController@destroy');

    // Woice grades controller
    Route::get('posts/{post_id}/grades', 'WoiceGradesController@show');
    Route::post('posts/{post_id}/grades/create', 'WoiceGradesController@store');
    Route::post('posts/{post_id}/grades/{grade_id}/update', 'WoiceGradesController@update');

    Route::post('invite/request', 'InviteController@requestInvite');
    Route::post('invite/email', 'InviteController@sendEmailInvite');
    Route::post('invite/remainder', 'InviteController@sendRemainderInvite');
    Route::post('invite/delete', 'InviteController@DeleteInvite');
    Route::post('newsletter/email', 'NewsletterController@sendNewsletter');
    Route::get('getinvitecode/{email}', 'InviteController@getInviteCode');
    Route::get('invite/{code}', 'InviteController@getInvite');

    Route::get('users/{id}/friends', 'FriendsController@index');
    Route::get('users/{id}/{circle_id}/circlefriends', 'FriendsController@getFriendsForCircle');
    Route::get('users/{id}/{group_id}/groupfriends', 'FriendsController@getFriendsForGroup');
    Route::get('users/{id}/{event_id}/eventfriends', 'FriendsController@getFriendsForEvents');
    //getFriendsForCircle
//getFriendsForEvents
    Route::post('users/autofriend', 'FriendsController@autoFriend');
    Route::post('users/friend/request', 'FriendsController@sendFriendRequest');
    Route::post('users/friend/request/accept', 'FriendsController@acceptFriendInviteRequest');
    Route::post('users/friend/request/reject', 'FriendsController@rejectFriendInviteRequest');
    Route::get('users/{user_id}/friend/requests', 'FriendsController@getAllFriendRequests');

    // Circle methods.
    Route::get('users/circles/all', 'CirclesController@index');
    Route::get('users/{id}/circles', 'CirclesController@getMyCircles');
    Route::get('users/circles/{circle_id}', 'CirclesController@showCircle');
    Route::post('users/circles/create', 'CirclesController@store');
    Route::post('users/circles/add_friend', 'CirclesController@addToCircle');
    Route::post('users/circles/remove_friend', 'CirclesController@removeFromCircle');
    Route::post('users/circles/update', 'CirclesController@update');
    Route::get('users/circles/{circle_id}/delete', 'CirclesController@destroy');

    // Albums methods.
    Route::get('users/albums/all', 'AlbumController@index');
    Route::get('users/{id}/albums', 'AlbumController@getMyAlbums');
    Route::get('users/albums/{album_id}', 'AlbumController@showAlbum');
    Route::post('users/albums/create', 'AlbumController@store');
    Route::post('users/albums/add_images', 'AlbumController@addImages');
    Route::post('users/albums/remove_images', 'AlbumController@removeImages');
    Route::post('users/albums/update', 'AlbumController@update');
    Route::get('users/albums/{album_id}/delete', 'AlbumController@destroy');
    Route::post('users/albums/image/comment/add', 'AlbumController@addImageComment');
    Route::post('users/albums/image/comment/delete', 'AlbumController@removeImageComment');
    Route::get('users/albums/image/grade/{album_image_id}/get', 'AlbumController@showGrade');
    Route::post('users/albums/image/grade/add', 'AlbumController@storeGrade');
    Route::post('users/albums/comment/add', 'AlbumController@addComment');
    Route::post('users/albums/image/comment/remove', 'AlbumController@removeComment');
    Route::post('users/albums/grade/add', 'AlbumController@storeAlbumGrade');
    Route::get('users/albums/grade/{album_id}/get', 'AlbumController@showAlbumGrade');

    //store
    Route::post('users/store/{user_id}/add', 'StoreController@store');
    Route::post('users/store/step2/{user_id}/add', 'StoreController@storeStep2');
    Route::post('users/store/step3/{user_id}/add', 'StoreController@storeStep3');
    Route::post('users/store/step4/{user_id}/add', 'StoreController@storeStep4');
    Route::post('users/store/updatestorefooter/{user_id}/update', 'StoreController@UpdateStoreFooterInfo');
    Route::post('users/store/updatestorestatus/update', 'StoreController@updateStoreStatus');
    Route::get('users/store/getstorestatus/{store_id}/get', 'StoreController@getStoreStatus');
    Route::get('users/store/getstorestatus/enums', 'StoreController@getStoreStatusEnum');


    //UpdateStoreFooterInfo
    Route::post('users/store/step5/{user_id}/add', 'StoreController@storeStep5');
    Route::post('users/store/step6/{user_id}/add', 'StoreController@storeStep6');
    Route::post('users/store/commerce/{user_id}/add', 'StoreController@SaveCommerceData');
    //

    Route::get('users/store/listing/get', 'StoreController@getAllStoreListing');
    Route::get('users/store/subscription/get', 'StoreController@getAllStoreSubscription');

    Route::get('stores', 'StoreController@getAllStores');
    Route::get('stores/{store_id}/get', 'StoreController@getStoreById');
    Route::get('stores/subcategory/{store_subcategory_id}/get', 'StoreController@getStoreBySubCategoryId');
    Route::get('stores/owner/{user_id}/get', 'StoreController@getStoreByOwner');
    Route::get('stores/owner/{user_id}/type/{typeId}/get', 'StoreController@getStoreByOwnerAndType');
    Route::get('stores/type/{typeId}/get', 'StoreController@getStoreByType');
    Route::post('stores/search/advanced', 'StoreController@searchStore');


    Route::get('stores/{store_id}/comments', 'StoreFrontController@getStoreComments');
    Route::post('stores/comments', 'StoreFrontController@addStoreComment');
    Route::put('stores/comments', 'StoreFrontController@updateStoreComment');
    Route::post('stores/comments/delete', 'StoreFrontController@deleteStoreComment');
    Route::get('stores/{store_id}/grades/{user_id}', 'StoreFrontController@getStoreGrades');
    Route::post('stores/grade', 'StoreFrontController@addGrade');
    Route::post('stores/restream', 'StoreFrontController@createStoreStream');
    Route::get('stores/{store_id}/restreams', 'StoreFrontController@getStoreRestreams');

    //Products Route
    Route::post('stores/productline/store', 'ProductController@store');
    Route::post('stores/productline/{storeId}/update', 'ProductController@update');
    Route::get('stores/productline/{storeId}/get', 'ProductController@getProductLineByStoreId');
    Route::get('store/productlines/{productline_id}', 'ProductController@getProductLine');
    Route::get('stores/productline/{id}/delete', 'ProductController@destroy');
    Route::get('stores/product/{id}/delete', 'ProductController@deleteProduct');

    //DeleteProduct

    Route::post('stores/product/add', 'ProductController@AddProduct');
    Route::post('stores/product/{productId}/update', 'ProductController@UpdateProduct');
    Route::post('stores/product/productSKU/{productSKUId}/update', 'ProductController@UpdateProductSKU');
    Route::post('stores/product/productSKU/{productId}/add', 'ProductController@AddProductSKU');
    Route::post('stores/product/productStock/{productSKUId}/update', 'ProductController@UpdateProductStock');
    Route::post('stores/product/productImages/{productSKUId}/add', 'ProductController@AddProductImages');
    Route::get('stores/product/productImages/{productImageId}/delete', 'ProductController@DeleteProductImages');
    Route::get('stores/product/productSKU/{productSKUId}/delete', 'ProductController@DeleteProductSKU');
    Route::get('stores/productline/products/{productlineId}/get', 'ProductController@getAllProducts');
    Route::get('stores/products/{productId}/get', 'ProductController@getProductById');
    Route::get('stores/productline/products/{productLineId}/get', 'ProductController@getProductsByProductLineId');
    Route::post('stores/products/{product_id}/variants', 'ProductController@getProductVariants');
    Route::post('stores/product/trendingproduct/{productSKUId}/update', 'ProductController@UpdateTrendingProduct');
    Route::post('stores/products/{product_id}/rfi/create', 'ProductController@createRequestInfo');
    Route::post('stores/{store_id}/rfq/create', 'StoreController@createRequestQuote');

    Route::get('stores/products/sku/{productId}/get', 'ProductController@getProductSKUByProductId');

    Route::get('users/stores/{store_id}/products/rfi', 'StoreController@getProductsRfi');
    Route::get('users/stores/{store_id}/rfq', 'StoreController@getStoreRfq');
//    /getProductSKUByProductId

//getProductLineByStoreId
    // Classifieds Routes

    Route::get('classifieds', 'ClassifiedsController@index');
    Route::get('classifieds/{sub_cat_id}', 'ClassifiedsController@getClassifieds');
    Route::post('classifieds/search/advanced', 'ClassifiedsController@searchClassifieds');
    Route::get('users/{user_id}/classifieds', 'ClassifiedsController@getMyClassifieds');
    Route::get('users/classifieds/{classified_id}', 'ClassifiedsController@getClassified');
    Route::get('users/classifieds/tags/{tag_id}/remove', 'ClassifiedsController@removeClassifiedTag');
    Route::post('users/classifieds/{classified_id}/status/update', 'ClassifiedsController@updateClassifiedStatus');

    Route::post('users/{user_id}/classifieds/step1/add', 'ClassifiedsController@storeStep1');
    Route::post('users/{user_id}/classifieds/step2/add', 'ClassifiedsController@storeStep2');
    Route::post('users/{user_id}/classifieds/step3/add', 'ClassifiedsController@storeStep3');

    Route::post('classifieds/{classified_id}/rfi/create', 'ClassifiedsController@createRequestInfo');
    Route::get('users/classifieds/{classified_id}/rfi', 'ClassifiedsController@getRequestForInfo');

    // Classified comments, grades, restreams

    Route::get('classifieds/{classified_id}/comments', 'ClassifiedDetailsController@getClassifiedComments');
    Route::post('classifieds/comments', 'ClassifiedDetailsController@addClassifiedComment');
    Route::put('classifieds/comments', 'ClassifiedDetailsController@updateClassifiedComment');
    Route::post('classifieds/comments/delete', 'ClassifiedDetailsController@deleteClassifiedComment');
    Route::get('classifieds/{classified_id}/grades/{user_id}', 'ClassifiedDetailsController@getClassifiedGrades');
    Route::post('classifieds/grade', 'ClassifiedDetailsController@addGrade');
    Route::post('classifieds/restream', 'ClassifiedDetailsController@createClassifiedStream');
    Route::get('classifieds/{classified_id}/restreams', 'ClassifiedDetailsController@getClassifiedRestreams');

    // Blogs methods.
    Route::get('users/blogs/published', 'BlogController@blogs');
    Route::get('users/{id}/blogs', 'BlogController@index');
    Route::post('users/blogs/create', 'BlogController@store');
    Route::post('users/blogs/update', 'BlogController@update');
    Route::post('users/blogs/{blog_id}/publish', 'BlogController@publishBlog');
    Route::post('users/blogs/{blog_id}/editasdraft', 'BlogController@EditAsDraft');
    Route::post('users/blogs/comment/add', 'BlogController@addComment');
    Route::post('users/blogs/comment/delete', 'BlogController@removeComment');
    Route::get('users/blogs/{blog_id}/delete', 'BlogController@destroy');
    Route::post('users/blogs/grade/add', 'BlogController@storeBlogGrade');
    Route::get('users/blogs/grade/{blog_id}/get', 'BlogController@showGrade');
    Route::get('users/blogs/{blog_id}', 'BlogController@show');
    Route::post('users/blogs/image/update', 'BlogController@updateBlogPhoto');
    Route::get('users/blogs/{blog_id}/cover_image/current', 'BlogController@getCoverPic');
    //storeBlogGrade

    // Event methods.
    Route::get('users/events/all', 'EventController@index');
    Route::get('event/{event_id}/delete', 'EventController@deleteEvent');
    Route::get('users/{id}/events', 'EventController@getMyEvents');
    Route::get('users/events/{event_id}', 'EventController@showEvent');
    Route::post('users/events/create', 'EventController@store');
    Route::post('users/events/image/update', 'EventController@updateEventPhoto');
    Route::get('users/events/{event_id}/cover_image/current', 'EventController@getCoverPic');
    //getCoverPic
    Route::post('users/events/invite', 'EventController@InviteToEvent');
    Route::get('users/{user_id}/events/invites/get', 'EventController@getEventInvites');
    Route::post('users/events/invite/rsvp', 'EventController@rsvpToEvent');
    Route::post('users/events/update', 'EventController@update');
    Route::get('users/events/{event_id}/delete', 'EventController@destroy');
    Route::post('users/events/grade/add', 'EventController@storeEventGrade');
    Route::get('users/events/grade/{event_id}/get', 'EventController@showGrade');

    //storeEventActivityGrade

    // Event activity methods.
    Route::get('users/events/{event_id}/activities/all', 'EventActivityController@index');
    Route::post('users/events/activities/create', 'EventActivityController@store');
    Route::post('users/events/activities/update', 'EventActivityController@update');
    Route::get('users/events/activities/{event_activity_id}/delete', 'EventActivityController@destroy');
    Route::post('users/events/activities/grade/add', 'EventActivityController@storeEventActivityGrade');
    Route::get('users/events/grade/{event_activity_id}/get', 'EventActivityController@showGrade');

    // Group methods.
    Route::get('users/groups/all', 'GroupsController@index');
    Route::get('users/{user_id}/groups', 'GroupsController@getMyGroups');
    Route::get('users/groups/{group_id}', 'GroupsController@showGroup');
    Route::get('users/groups/{group_id}/members/{user_id}/isValid', 'GroupsController@isValidGroupMember');
    Route::post('users/groups/create', 'GroupsController@store');
    Route::post('users/groups/member/add', 'GroupsController@addToGroup');
    Route::post('users/groups/member/remove', 'GroupsController@removeFromGroup');
    Route::post('users/groups/member/request', 'GroupsController@requestAddToGroup');
    Route::get('users/groups/requests/owner/{owner_id}', 'GroupsController@getAllGroupRequests');
    Route::get('users/groups/requests/member/{user_id}', 'GroupsController@getAllAddRequests');
    Route::post('users/groups/requests/owner/accept', 'GroupsController@approveMember');
    Route::post('users/groups/requests/owner/reject', 'GroupsController@rejectMember');
    Route::post('users/groups/update', 'GroupsController@update');
    Route::get('users/groups/{group_id}/delete', 'GroupsController@destroy');
    Route::post('users/groups/grade/add', 'GroupsController@storeGroupGrade');
    Route::get('users/groups/grade/{group_id}/get', 'GroupsController@showGrade');
    Route::post('users/groups/image/update', 'GroupsController@updateGroupPhoto');
    Route::get('users/groups/{group_id}/cover_image/current', 'GroupsController@getCoverPic');


    //getFriendsForGroup

    // Group activity methods
    Route::get('users/groups/{group_id}/activities', 'GroupActivityController@index');
    Route::post('users/groups/activities/create', 'GroupActivityController@store');
    Route::get('users/groups/activities/{group_activity_id}', 'GroupActivityController@show');
    Route::post('users/groups/activities/update', 'GroupActivityController@update');
    Route::get('users/groups/activities/{group_activity_id}/delete', 'GroupActivityController@destroy');
    Route::post('users/groups/activities/comment/add', 'GroupActivityController@addComment');
    Route::post('users/groups/activities/comment/update', 'GroupActivityController@updateComment');
    Route::get('users/groups/activities/comment/{comment_id}/delete', 'GroupActivityController@removeComment');
    Route::post('users/groups/activities/grade/add', 'GroupActivityController@storeGroupActivityGrade');
    Route::get('users/groups/activities/grade/{group_activity_id}/get', 'GroupActivityController@showGrade');

    // Forum methods
    Route::get('users/forums/all', 'ForumController@index');
    Route::get('users/forums/{forum_id}', 'ForumController@show');
    Route::get('users/{id}/forums', 'ForumController@getMyForums');
    Route::get('users/{user_id}/forums', 'ForumController@getMyForums');
    Route::post('users/forums/create', 'ForumController@store');
    Route::post('users/forums/update', 'ForumController@update');
    Route::post('users/forums/reply/add', 'ForumController@addReply');
    Route::get('users/forums/reply/{reply_id}/remove', 'ForumController@removeReply');
    Route::post('users/forums/reply/update', 'ForumController@updateReply');
    Route::get('users/forums/{forum_id}/delete', 'ForumController@destroy');
    Route::post('users/forums/grade/add', 'ForumController@storeForumGrade');
    Route::get('users/forums/grade/{forum_id}/get', 'ForumController@showGrade');

    Route::get('mail/send', 'AdminController@sendMail');

    Route::post('image/upload', 'ImageController@uploadImage');
    Route::post('file/upload', 'FileController@uploadFile');

    Route::post('image/crop', 'ImageController@cropImage');

    Route::get('image/show/{imagename}', 'ImageController@showImage');

    Route::get('image/show/{imagename}/{w?}/{h?}', 'ImageController@showScaledImage');

    Route::post('buyer', 'OrderController@getBuyerDetails');
    Route::post('orders', 'OrderController@store');
    Route::get('orders/{buyer_id}/buyer', 'OrderController@getBuyersOrder');
    Route::post('orders/payu/hash', 'OrderController@getHash');
    //getHash()
});

Route::group(array('prefix' => 'v1', 'before' => 'jwt-auth'), function () {
    Route::get('orders', 'OrderController@index');
    Route::post('order/item/status/update', 'OrderController@updateOrderStatus');
    Route::post('order/status/update', 'OrderController@updateOrder');
    Route::get('order/status/enums', 'OrderController@getOrderStatusEnums');
});



