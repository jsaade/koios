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


//Group routes that requires user authentication
Route::group(array('before' => 'auth'), function()
{
	Route::group(array('prefix' => 'application/{application}'), function()
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