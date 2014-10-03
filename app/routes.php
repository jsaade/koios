<?php

//Group routes that requires authentication
Route::group(array('before' => 'auth'), function()
{
    //Application routing
    Route::model('application', 'Application');
    Route::bind('application', function($value, $route){
    	return Application::where('slug', $value)->first();
    });
	Route::resource('application', 'ApplicationController');
	
	//homepage routing
	Route::get('/', 'ApplicationController@index');
});

//Authentication restful routing
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);
