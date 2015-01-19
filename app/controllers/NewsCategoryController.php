<?php

class NewsCategoryController extends \BaseController {

	protected $news_category;

	public function __construct(NewsCategory $news_category)
	{
		$this->news_category = $news_category;
		View::share('showAppMenu',true);
	}

	public function index(Application $application)
	{
		$sortUrl = route('news-categories.sort', [$application->slug]);
		$categories = NewsCategory::roots()->whereApplicationId($application->id)->get();
		return View::make('news_category.index')->withApplication($application)->withCategories($categories)->withSortUrl($sortUrl);
	}


	public function store(Application $application)
	{
		$input = Input::all();

		if(Request::ajax())
		{
			if($this->news_category->isValid($input))
			{
				$this->news_category->create($input);
				$categories = NewsCategory::roots()->whereApplicationId($application->id)->get();
				$view = View::make('news_category.partials._list')->withCategories($categories)->withApplication($application);
				$response = ['data' => $view->render()];
				return Response::json($response);
			}

			return Response::json(['errors' => $this->news_category->errors]); 
		}
		
	}

	public function edit(Application $application, NewsCategory $news_category)
	{
		$this->news_category = $news_category;
		return View::make('news_category.edit')->withApplication($application)->withCategory($news_category);
	}


	public function update(Application $application, NewsCategory $news_category)
	{
		$input = Input::all();
		$this->news_category = $news_category;

		if($this->news_category->isValid($input))
		{
			$this->news_category->update($input);
			return Redirect::route('application.{application}.news-categories.index', $application->slug);
		}
		return Redirect::route('application.{application}.news-categories.edit', [$application->slug, $this->news_category->id])
				->withInput()
				->withErrors($this->news_category->errors);
	}


	public function destroy(Application $application, NewsCategory $news_category)
	{
		if(Request::ajax())
		{
			$news_category->delete();
			$response = ['data' => "destroyed"];
		}
	}


	public function sort(Application $application)
	{
		if(Request::ajax())
		{
			$input = Input::all();
			$json = $input['json_string'];
			$cats = json_decode($json, true);
			
			//buildTree() not working moving back a node as root (parent null)
			//had to do it manually
			foreach($cats as $key => $val)
			{
				$category = NewsCategory::findOrFail($val['id']);
				$category->makeRoot();
			}
			
			//update the sort order
			$cats = NewsCategory::updateNestedSetOrder($cats);
			//build tree
			NewsCategory::buildTree($cats);
		}
	}

}