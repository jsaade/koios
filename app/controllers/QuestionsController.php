<?php

class QuestionsController extends \BaseController {

	protected $question;

	public function __construct(Question $question)
	{
		$this->question = $question;
		View::share('showAppMenu',true);
	}

	public function index(Application $application)
	{
		$questions = $application->questions;
		return View::make('question.index')->withApplication($application)->withQuestions($questions);
	}


	public function create(Application $application)
	{
		return View::make('question.create')->withApplication($application)->withQuestion($this->question);
	}


	public function store(Application $application)
	{
		$input = Input::all();
		$uploaded_image = Input::file('image');

		if($this->question->isValid($input))
		{
			$this->question = Question::create($input);
			$this->question->uploadImage($uploaded_image);
			$this->question->createOrUpdateAnswers($input);
			return Redirect::route('application.{application}.questions.index', $application->slug);
		}

		return Redirect::route('application.{application}.questions.create', $application->slug)->withInput()->withErrors($this->question->errors);
	}


	public function edit(Application $application, Question $question)
	{
		return View::make('question.edit')->withApplication($application)->withQuestion($question);
	}


	public function update(Application $application, Question $question)
	{
		$input = Input::all();
		$uploaded_image = Input::file('image');
		$this->question = $question;

		if($this->question->isValid($input))
		{
			$this->question->update(['description' => $input['description']]);
			$this->question->uploadImage($uploaded_image);
			$this->question->createOrUpdateAnswers($input);
			return Redirect::route('application.{application}.questions.index', $application->slug);
		}

		return Redirect::route('application.{application}.questions.edit', [$application->slug, $this->question->id])
				->withInput()
				->withErrors($this->question->errors);
	}


	public function destroy(Application $application, Question $question)
	{
		if(Request::ajax())
		{
			$question->delete();
			$response = ['data' => "destroyed"];
		}
	}

}