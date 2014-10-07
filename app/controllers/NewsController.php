<?php

class NewsController extends \BaseController {

	
	protected $news;

	public function __construct(News $news)
	{
		$this->news = $news;
	}


	public function index(Application $application)
	{
		$news = News::with('newsCategory')->where('application_id', $application->id)->get();
		return View::make('news.index')->withNews($news)->withApplication($application);
	}


	public function create(Application $application)
	{
		$news_categories = $application->newsCategories->lists('name', 'id');
		return View::make('news.create')->with('news_categories', $news_categories)->withApplication($application);
	}


	public function store(Application $application)
	{
		$input = Input::all();
		$uploaded_image = Input::file('image');

		if($this->news->isValid($input))
		{
			$this->news = News::create($input);
			$this->news->uploadImage($uploaded_image);
			return Redirect::route('application.{application}.news.index', $application->slug);
		}

		return Redirect::route('application.{application}.news.create', $application->slug)
				->withInput()
				->withErrors($this->news->errors);
	}


	public function edit(Application $application, News $news)
	{
		$news_categories = $application->newsCategories->lists('name', 'id');
		return View::make('news.edit')->with('news_categories', $news_categories)->withApplication($application)->withNews($news);
	}

	
	public function update(Application $application, News $news)
	{
		$input = Input::all();
		$uploaded_image = Input::file('image');
		$this->news = $news;

		if($this->news->isValid($input))
		{
			$this->news->update($input);
			$this->news->uploadImage($uploaded_image);
			return Redirect::route('application.{application}.news.index', $application->slug);
		}

		return Redirect::route('application.{application}.news.edit', [$application->slug, $this->news->id])
				->withInput()
				->withErrors($this->news->errors);
	}


	public function destroy(Application $application, News $news)
	{
		if(Request::ajax())
		{
			$news->delete();
			$response = ['data' => "destroyed"];
		}
	}

}