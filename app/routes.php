<?php

//Group routes that requires authentication
Route::group(array('before' => 'auth'), function()
{
    //Application restful routing
	Route::resource('application', 'ApplicationController');
});

//Authentication restful routing
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);

//homepage
Route::get('/', function()
{
	return View::make('hello');
});
