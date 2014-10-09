<?php

//Model Bindings
Route::model('application', 'Application');
Route::bind('application', function($value, $route){
    return Application::where('slug', $value)->first();
});

Route::model('news', 'News');
Route::model('news_categories', 'NewsCategory');
Route::model('questions', 'Question');
Route::bind('questions', function($value, $route){
    return Question::with('answers')->find($value);
});


Route::model('app', 'Application');
Route::bind('app', function($value, $route){
	return Application::where('api_key', $value)->first();
});

//Api Routes
Route::group(['prefix'=>'api/', 'before'=>'secure'], function()
{
	Route::get('app/{app}/news', 'ApiController@news');
	Route::get('app/{app}/news/{news}/show', 'ApiController@news_show');
	Route::get('app/{app}/news-categories', 'ApiController@news_categories');
	Route::get('app/{app}/news-category/{news_categories}/news', 'ApiController@news_by_category');
	Route::resource('app', 'ApiController');
});

//Group routes that requires user authentication
Route::group(['before'=>'auth'], function()
{
	Route::group(['prefix' => 'application/{application}'], function()
	{
		Route::resource('news', 'NewsController');
		Route::resource('news-categories', 'NewsCategoryController');
		Route::resource('questions', 'QuestionsController');
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