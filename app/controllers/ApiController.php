<?php

class ApiController extends \BaseController {

	public function show(Application $application)
	{
		return $application;
	}

	// lists all news available in the application
	public function news(Application $application)
	{
		return News::with('newsCategory')
				->where('application_id', $application->id)
				->get();
	}

	//shows a single news
	public function news_show(Application $application, News $news)
	{
		return $news;
	}

	//lists the news categories available in the application
	public function news_categories(Application $application)
	{
		return $application->newsCategories;
	}

	//lists the news filtered by a category
	public function news_by_category(Application $application, NewsCategory $news_category)
	{
		return $news_category->news;
	}

}