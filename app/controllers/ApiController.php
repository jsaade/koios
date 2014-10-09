<?php

use \Acme\Repositories\DbNewsRepository;
use \Acme\Repositories\DbNewsCategoryRepository;
use \Acme\Repositories\DbQuestionRepository;

class ApiController extends \BaseController {

	public function __construct(DbNewsCategoryRepository $newsCategoryRepos, DbNewsRepository $newsRepos, DbQuestionRepository $questionRepos)
	{
		$this->newsCategoryRepos = $newsCategoryRepos;
		$this->newsRepos         = $newsRepos;
		$this->questionRepos     = $questionRepos;
	}


	public function show(Application $application)
	{
		return $application;
	}

	// lists all news available in the application
	public function news(Application $application)
	{
		return Response::make(['code' => 200, 'data' => $this->newsRepos->getAll($application) ]);
	}

	//shows a single news
	public function news_show(Application $application, News $news)
	{
		return Response::make(['code' => 200, 'data' => $this->newsRepos->find($news->id) ]);
	}

	//lists the news categories available in the application
	public function news_categories(Application $application)
	{
		return Response::make(['code' => 200, 'data' => $this->newsCategoryRepos->getAll($application) ]);
	}

	//lists the news filtered by a category
	public function news_by_category(Application $application, NewsCategory $news_category)
	{
		return Response::make(['code' => 200, 'data' => $this->newsCategoryRepos->getNews($news_category) ]);
	}

	// lists all questions available in the application
	public function questions(Application $application)
	{
		return Response::make(['code' => 200, 'data' => $this->questionRepos->getAll($application) ]);
	}

	//shows a single question
	public function questions_show(Application $application, Question $questions)
	{
		return Response::make(['code' => 200, 'data' => $this->questionRepos->find($questions->id) ]);
	}

}