<?php

use \Acme\ApiParser\QuestionApiParser;
use \Acme\Repositories\DbQuestionRepository;

class ApiQuestionController extends \ApiController {


	protected $questionApiParser;
	protected $questionRepos;

	public function __construct(QuestionApiParser $questionApiParser, DbQuestionRepository $questionRepos)
	{
		$this->questionApiParser = $questionApiParser;
		$this->questionRepos = $questionRepos;
	}


	// Gets the list of questions
	public function index(Application $application)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$questions = $this->questionRepos->getAll($application, $limit, $page);
		return $this->respondOk($this->questionApiParser->parseCollection($questions));
	}


	// Gets a single questino	
	public function show(Application $application, Question $question)
	{
		$question = $this->questionRepos->find($question->id);
		return $this->respondOk($this->questionApiParser->parse($question));
	}


}