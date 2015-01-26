<?php
use \Acme\Repositories\DbNewsRepository;

class NewsController extends \BaseController {

	
	protected $news, $newsRepos;

	public function __construct(News $news, DbNewsRepository $newsRepos)
	{
		$this->news = $news;
		$this->newsRepos = $newsRepos;
		View::share('showAppMenu',true);
	}


	public function index(Application $application)
	{
		$limit = (Input::get('limit'))?Input::get('limit'):$application->pagination_per_page;
		$page = Input::get('page');
		$category_id = (Input::get('category'))?Input::get('category'):null;
		
		$cats = $application->newsCategories->lists('name', 'id');
		$news = $this->newsRepos->getAll($application, $limit, $page, $category_id, "object",null);
		$url = route('application.{application}.news.index', [$application->slug]);
		return View::make('news.index')->withNews($news)->withApplication($application)->withCats($cats)->withCategoryId($category_id)->withUrl($url);
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
			if($uploaded_image)
				$this->news->uploadImage($uploaded_image);

			Flash::success('News was created successfully.');
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
			unset($input['image']);
			$this->news->update($input);
			$this->news->uploadImage($uploaded_image);

			Flash::success('News was updated successfully.');
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