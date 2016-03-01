<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;

App::before(function($request)
{
	if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
		$statusCode = 204;

		$headers = [
//			'Access-Control-Allow-Origin'      => 'http://evezown.com',
			'Access-Control-Allow-Origin'      => 'http://creativethoughts.co.in',
			'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
			'Access-Control-Allow-Headers'     => 'Origin, Content-Type, Accept, Authorization, X-Requested-With',
			'Access-Control-Allow-Credentials' => 'true',
			'Access-Control-Max-Age'           => '86400'
		];

		return Response::make(null, $statusCode, $headers);
	}});

App::after(function($request, $response)
{
//	$response->headers->set('Access-Control-Allow-Origin', 'http://evezown.com');
	$response->headers->set('Access-Control-Allow-Origin', 'http://creativethoughts.co.in');
	$response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
	$response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With');
	$response->headers->set('Access-Control-Allow-Credentials', 'true');
	$response->headers->set('Access-Control-Max-Age','86400');
	return $response;
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest())
	{
		if (Request::ajax())
		{
			return "Not Authorized";
		}
		else
		{
			return "Not Authorized";
		}
	}


});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

Route::filter('admin', function()
{

});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() !== Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
