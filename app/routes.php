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


Route::group(array('prefix' => 'v1'), function () {

	//Rit
	// ------------------------ V-DRIVE ROUTE ----------------------------------
	Route::get('admin/getAllDrivers', 'AdminController@getRegisteredDrivers');
	Route::post('admin/addNewDriver', 'AdminController@driverRegistration');
	Route::post('admin/deleteDriver', 'AdminController@DeleteDriver');
	Route::get('admin/{user_id}/getDriverDetails', 'AdminController@getDriverDetails');
	Route::post('admin/updateDriverInfo', 'AdminController@updateDriverInfo');
	Route::get('admin/getAllDriveRequest', 'AdminController@getAllDriveRequest');
	
	
	// ------------------------ DRIVER APP ROUTE --------------------------------
	Route::get('driver/validateDriver/{driver_code}', 'DriverController@validateDriverLogin');
	Route::get('driver/getAllActiveDrivers', 'DriverController@getAllActiveDrivers');
	Route::post('driver/startDrive', 'DriveController@startDrive');
	
	// ------------------------ CUSTOMER APP ROUTE -------------------------------
	Route::post('customer/sendBookingRequest', 'DriveController@sendBookingRequest');
	Route::post('customer/assignDriverForRide', 'DriveController@assignDriverForRide');
	
	
	
	
	
});




