<?php

use \Acme\ApiParser\NewsApiParser;
use \Acme\Repositories\DbNewsRepository;

class ApiNewsController extends \ApiController {


	protected $newsApiParser;
	protected $newsRepos;

	public function __construct(NewsApiParser $newsApiParser, DbNewsRepository $newsRepos)
	{
		$this->newsApiParser = $newsApiParser;
		$this->newsRepos = $newsRepos;
	}


	// Gets the list of news
	public function index(Application $application)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$news = $this->newsRepos->getAll($application, $limit, $page);
		return $this->respondOk($this->newsApiParser->parseCollection($news));
	}

	// Gets all news inside a category	
	public function category(Application $application, NewsCategory $newsCategory)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$news = $this->newsRepos->getAll($application, $limit, $page, $newsCategory->id);
		return $this->respondOk($this->newsApiParser->parseCollection($news));

	}

	// Gets a single news	
	public function show(Application $application, News $news)
	{
		$news = $this->newsRepos->find($news->id);
		return $this->respondOk($this->newsApiParser->parse($news));
	}


}