<?php
/*******************
 * Models bindings *
 *******************/
Route::model('application', 'Application');
Route::bind('application', function($value, $route){
    return Application::where('slug', $value)->first();
});

Route::model('contact_forms', 'ContactForm');
Route::model('subscribers', 'Subscriber');
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


/**************
 * API ROUTES *
 **************/
Route::group(['prefix'=>'api/', 'before'=>'secure'], function()
{
	//Contact Form
	Route::post('app/{app}/contact-forms/{contact_forms}/create', 'ApiContactFormController@storeValues')->before('contactFormAppRelation');;
	Route::post('app/{app}/contact-forms/{contact_forms}/add-attachements', 'ApiContactFormController@storeAttachements')->before('contactFormAppRelation');;
	//LeaderBoard
	Route::get('app/{app}/leaderboard/{order}', ['as' => 'api.leaderboard', 'uses' => 'ApiLeaderboardController@index']);
	Route::get('app/{app}/leaderboard/meta/{order}', ['as' => 'api.leaderboard.meta', 'uses' => 'ApiLeaderboardController@meta']);
	//Logins
	Route::post('app/{app}/subscribers/login-via-email', 'ApiSubscriberController@loginViaEmail');
	Route::post('app/{app}/subscribers/login-via-facebook', 'ApiSubscriberController@loginViaFacebook');
	//Subscribers
	Route::get('app/{app}/subscribers', ['as' => 'api.subscribers', 'uses' => 'ApiSubscriberController@index']);
	Route::get('app/{app}/subscribers/{subscribers}/show', ['as' => 'api.subscribers.show', 'uses' => 'ApiSubscriberController@show'])->before('subscriberAppRelation');
	Route::get('app/{app}/subscribers/{subscribers}/game-info', ['as' => 'api.subscribers.game-info', 'uses' => 'ApiSubscriberController@gameInfo'])->before('subscriberAppRelation');
	Route::post('app/{app}/subscribers/register', 'ApiSubscriberController@register');
	Route::post('app/{app}/subscribers/create', 'ApiSubscriberController@store');
	Route::post('app/{app}/subscribers/{subscribers}/create-profile', 'ApiSubscriberController@storeProfile')->before('subscriberAppRelation')->before('token');                                                                                                                                                                                                                                                                                                      
	Route::post('app/{app}/subscribers/{subscribers}/add-device', 'ApiSubscriberController@storeDevice')->before('subscriberAppRelation')->before('token');                                                                                                                                                                                                                                                                                                      
	//Subscriber Quiz
	Route::post('app/{app}/subscribers/{subscribers}/questions/{questions}/answer', 'ApiSubscriberController@storeQuestionSubscriber')->before('subscriberAppRelation')->before('questionAppRelation')->before('token');                                                                                                                                                                                                                                                                                                      
	Route::get('app/{app}/subscribers/{subscribers}/answers', 'ApiSubscriberController@answers')->before('subscriberAppRelation');                                                                                                                                                                                                                                                                                                      
	//Subscribers gaming
	Route::post('app/{app}/subscribers/{subscribers}/update', 'ApiSubscriberController@update')->before('subscriberAppRelation')->before('token');
	Route::post('app/{app}/subscribers/{subscribers}/add-game-meta', 'ApiSubscriberController@storeGameMeta')->before('subscriberAppRelation')->before('token');
	Route::post('app/{app}/subscribers/{subscribers}/update-game-meta/{meta_key}', 'ApiSubscriberController@updateGameMeta')->before('subscriberAppRelation')->before('token');
	Route::post('app/{app}/subscribers/{subscribers}/delete-game-meta/{meta_key}', 'ApiSubscriberController@destroyGameMeta')->before('subscriberAppRelation')->before('token');
	//News 
	Route::get('app/{app}/news', ['as' => 'api.news', 'uses' => 'ApiNewsController@index']);
	Route::get('app/{app}/news/{news}/show', ['as' => 'api.news.show', 'uses' => 'ApiNewsController@show'])->before('newsAppRelation');
	Route::get('app/{app}/news/category/{news_categories}', ['as' => 'api.news.category', 'uses' => 'ApiNewsController@category'])->before('newsCategoryAppRelation');
	//News Categories
	Route::get('app/{app}/news-categories', ['as' => 'api.news_category', 'uses' => 'ApiNewsCategoryController@index']);
	Route::get('app/{app}/news-categories/{news_categories}/show', ['as' => 'api.news_category.show', 'uses' => 'ApiNewsCategoryController@show']);
	//Questions 
	Route::get('app/{app}/questions', ['as' => 'api.questions', 'uses' => 'ApiQuestionController@index']);
	Route::get('app/{app}/questions/{questions}/show', ['as' => 'api.questions.show', 'uses' => 'ApiQuestionController@show'])->before('questionAppRelation');
	
	//Route::resource('app', 'ApiController');
});


/**********************
 * APPLICATION ROUTES *
 **********************/
Route::group(['before'=>'auth'], function()
{
	Route::group(['prefix' => 'application/{application}'], function()
	{
		Route::resource('contact-forms', 'ContactFormController');
		Route::resource('news', 'NewsController');
		Route::resource('news-categories', 'NewsCategoryController');
		Route::post('news-categories/sort', [ 'as' => 'news-categories.sort' ,'uses' => 'NewsCategoryController@sort']);
		Route::post('certificates', ['as' => 'application.certificates', 'uses' => 'ApplicationController@certificates']);
		Route::resource('questions', 'QuestionsController');
	});

    //Application routing
	Route::resource('application', 'ApplicationController');

	//Developer routing
	Route::get('developer/api', 'DeveloperController@api');
	Route::get('developer/console', 'DeveloperController@console');
	Route::post('developer/response', 'DeveloperController@response');
	//homepage routing
	Route::get('/', ['as' => 'home', 'uses' => 'ApplicationController@index']);
});

//Authentication 
Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');
Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);