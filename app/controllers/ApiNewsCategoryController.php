<?php

use \Acme\ApiParser\NewsCategoryApiParser;
use \Acme\Repositories\DbNewsCategoryRepository;

class ApiNewsCategoryController extends \ApiController {

	protected $newsCategoryApiParser, $newsCategoryRepos;

	public function __construct(NewsCategoryApiParser $newsCategoryApiParser, DbNewsCategoryRepository $newsCategoryRepos)
	{
		$this->newsCategoryApiParser = $newsCategoryApiParser;
		$this->newsCategoryRepos = $newsCategoryRepos;
	}


	// Gets the list of news
	public function index(Application $application)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$newsCategories = $this->newsCategoryRepos->getAll($application, $limit, $page);
		return $this->respondOk($this->newsCategoryApiParser->parseCollection($newsCategories));
	}

	// Gets a single news category	
	public function show(Application $application, NewsCategory $newsCategory)
	{
		$news_category = $this->newsCategoryRepos->find($newsCategory->id);
		return $this->respondOk($this->newsCategoryApiParser->parse($news_category));
	}
}