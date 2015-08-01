<?php

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

/*
|  Frontend group
*/
Route::group(['namespace' => 'Frontend', 'as' => 'frontend'], function() {
	// Main page
	Route::get('/', function () {

	    return view('Frontend.welcome');
	});
	// Contact 
	Route::get('contact', 'ContactController@index');

	Route::get('{alias}', ['as' => 'pages', 'uses' => 'PagesController@index'])->where(['alias' => '[a-z0-9-]+']);
	Route::get('{alias}/page/{page}', ['as' => 'pages', 'uses' => 'PagesController@index'])->where(['alias' => '[a-z0-9-]+', 'page' => '[0-9]+']);
});

/*
| Backend group
*/
Route::group(['namespace' => 'Backend', 'as' => 'backend.', 'middleware' => 'auth', 'prefix' => 'backend'], function() {
	// Index page
	Route::get('/', ['as' => 'home', 'uses' => "IndexController@index"]);

	// Links to controller Pages
	Route::get('pages', ['as' => 'pages', 'uses' => "PagesController@index"]);
	Route::get('pages/create', ["as" => "pages.create", "uses" => "PagesController@create"]);
	Route::post('pages/create', "PagesController@store");
	Route::get('pages/edit/{id}', ["as" => "pages.edit", "uses" => "PagesController@edit"])->where(['id' => '[0-9]+']);
	Route::post('pages/edit/{id}', "PagesController@update")->where(['id' => '[0-9]+']);
	Route::get('pages/destroy/{id}', ["as" => "pages.destroy", "uses" => "PagesController@destroy"])->where(['id' => '[0-9]+']);

	// Links to controller News
	Route::get('news', ['as' => 'news', 'uses' => "NewsController@index"]);
	Route::get('news/create', ["as" => "news.create", "uses" => "NewsController@create"]);
	Route::post('news/create', "NewsController@store");
	Route::get('news/edit/{id}', ["as" => "news.edit", "uses" => "NewsController@edit"])->where(['id' => '[0-9]+']);
	Route::post('news/edit/{id}', "NewsController@update")->where(['id' => '[0-9]+']);
	Route::get('news/destroy/{id}', ["as" => "news.destroy", "uses" => "NewsController@destroy"])->where(['id' => '[0-9]+']);



	// Notifications for Smoke.js plugin
	Route::get('notifications', function() {
		return json_encode(getMessages());
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