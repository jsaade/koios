<?php

class NewsCategoryController extends \BaseController {

	protected $news_category;

	public function __construct(NewsCategory $news_category)
	{
		$this->news_category = $news_category;
	}

	public function index(Application $application)
	{
		$categories = $application->newsCategories;
		return View::make('news_category.index')->withApplication($application)->withCategories($categories);
	}


	public function store(Application $application)
	{
		$input = Input::all();

		if(Request::ajax())
		{
			if($this->news_category->isValid($input))
			{
				$this->news_category->Create($input);
				$categories = $application->newsCategories;
				$view = View::make('news_category.partials._list')->withCategories($categories);
				$response = ['data' => $view->render()];
				return Response::json($response);
			}

			return Response::json(['errors' => $this->news_category->errors]); 
		}
		
	}

	public function edit(Application $application, NewsCategory $news_category)
	{
		$this->news_category = $news_category;
		return ($this->news_category);
	}


	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}