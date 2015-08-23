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
| Backend group
*/
Route::group(['namespace' => 'Backend', 'as' => 'backend.', 'middleware' => 'auth', 'prefix' => 'backend'], function() {
	// Index page
	Route::get('/', ['as' => 'home', 'uses' => "IndexController@index"]);

	// Links to controller Pages
	Route::get('pages',              ['as' => 'pages', 'uses' => "PagesController@index"]);
	Route::get('pages/create',       ["as" => "pages.create", "uses" => "PagesController@create"]);
	Route::post('pages/create',      "PagesController@store");
	Route::get('pages/edit/{id}',    ["as" => "pages.edit", "uses" => "PagesController@edit"])->where(['id' => '[0-9]+']);
	Route::post('pages/edit/{id}',   "PagesController@update")->where(['id' => '[0-9]+']);
	Route::get('pages/destroy/{id}', ["as" => "pages.destroy", "uses" => "PagesController@destroy"])->where(['id' => '[0-9]+']);

	// Links to controller News
	Route::get('news',              ['as' => 'news', 'uses' => "NewsController@index"]);
	Route::get('news/create',       ["as" => "news.create", "uses" => "NewsController@create"]);
	Route::post('news/create',      "NewsController@store");
	Route::get('news/edit/{id}',    ["as" => "news.edit", "uses" => "NewsController@edit"])->where(['id' => '[0-9]+']);
	Route::post('news/edit/{id}',   "NewsController@update")->where(['id' => '[0-9]+']);
	Route::get('news/destroy/{id}', ["as" => "news.destroy", "uses" => "NewsController@destroy"])->where(['id' => '[0-9]+']);

	// Links to controller Articles
	Route::get('articles',              ['as' => 'articles', 'uses' => "ArticlesController@index"]);
	Route::get('articles/create',       ["as" => "articles.create", "uses" => "ArticlesController@create"]);
	Route::post('articles/create',      "ArticlesController@store");
	Route::get('articles/edit/{id}',    ["as" => "articles.edit", "uses" => "ArticlesController@edit"])->where(['id' => '[0-9]+']);
	Route::post('articles/edit/{id}',   "ArticlesController@update")->where(['id' => '[0-9]+']);
	Route::get('articles/destroy/{id}', ["as" => "articles.destroy", "uses" => "ArticlesController@destroy"])->where(['id' => '[0-9]+']);

	// Links to controller Contact
	Route::get('contact',              ['as' => 'contact', 'uses' => "ContactController@index"]);
	Route::get('contact/create',       ["as" => "contact.create", "uses" => "ContactController@create"]);
	Route::post('contact/create',      "ContactController@store");
	Route::get('contact/edit/{id}',    ["as" => "contact.edit", "uses" => "ContactController@edit"])->where(['id' => '[0-9]+']);
	Route::post('contact/edit/{id}',   "ContactController@update")->where(['id' => '[0-9]+']);
	Route::get('contact/destroy/{id}', ["as" => "contact.destroy", "uses" => "ContactController@destroy"])->where(['id' => '[0-9]+']);

	// Notifications for Smoke.js plugin
	Route::get('notifications', function() {
		return json_encode(getMessages());
	});

});

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
	Route::post('contact', 'ContactController@store');

	// Pages
	Route::get('{alias}', ['as' => 'pages', 'uses' => 'PagesController@index'])->where(['alias' => '[a-z0-9-]+']);
	Route::get('{alias}/page/{page}', ['as' => 'pages', 'uses' => 'PagesController@index'])->where(['alias' => '[a-z0-9-]+', 'page' => '[0-9]+']);
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