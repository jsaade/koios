<?php

//whenever application is passed in a route, it is bounded as a model
Route::model('application', 'Application');
Route::bind('application', function($value, $route){
    return Application::where('slug', $value)->first();
});

Route::model('news', 'News');
Route::model('news_categories', 'NewsCategory');

//Group routes that requires authentication
Route::group(array('before' => 'auth'), function()
{
	Route::group(array('prefix' => 'application/{application}'), function()
	{
		Route::resource('news-categories', 'NewsCategoryController');
		Route::resource('news', 'NewsController');
	});

    //Application routing
	Route::resource('application', 'ApplicationController');
	
	//homepage routing
	Route::get('/', 'ApplicationController@index');
});

//Authentication restful routing
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);