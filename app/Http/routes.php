<?php

// use DB;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Frontend group
Route::group(['namespace' => 'Frontend'], function() {
	// Main page
	Route::get('/', function () {
	    return view('Frontend.welcome');
	});
	// Contact 
	Route::get('contact', 'ContactController@index');


	Route::get('user/{id}', function ($id) {
	    $result = DB::table('users')->where('id', (int) $id)->get(); 
	    dd($result);
	    // return DB::table('users')->where('id', (int) $id)->get(); 
	});
});

// Backend group
Route::group(['namespace' => 'Backend', 'middleware' => 'auth', 'prefix' => 'backend'], function() {
	// Index page
	Route::get('', "IndexController@index");

	// Links to controller Pages
	Route::get('pages', "PagesController@index");
	Route::get('pages/create', "PagesController@create");
	Route::post('pages/create', "PagesController@store");
	Route::get('pages/edit/{id}', "PagesController@edit")->where(['id' => '[0-9]+']);
	Route::post('pages/edit/{id}', "PagesController@update")->where(['id' => '[0-9]+']);
	Route::get('pages/destroy/{id}', "PagesController@destroy")->where(['id' => '[0-9]+']);

	// Notifications for Smoke.js plugin
	Route::get('notifications', function() {
		$list = Session::get('notifications', []);
		Session::forget('notifications');
		return json_encode($list);
	});

});


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password recovery
Route::get('auth/recovery', 'Auth\PasswordController@getEmail');
Route::post('auth/recovery', 'Auth\PasswordController@postEmail');