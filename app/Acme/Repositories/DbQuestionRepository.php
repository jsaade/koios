<?php
namespace Acme\Repositories;
use Question;
use DB;

class DbQuestionRepository extends DbRepos
{
	/**
	 * Get all the questions of an application
	 * @param  Appliaction $application 
	 * @return Array
	 */
	public function getAll($application, $limit, $page, $rand = 0)
	{
		$output = ['data' => [], 'pages' => []];
		
		if(!$limit) $limit = 25;
		if(!$page) $page = 1;

		$questions = $application->questions();

		if($rand == 1)
			$questions = $questions->orderBy(DB::raw('RAND()'));
		else
			$questions = $questions->orderBy('created_at', 'desc');

		$questions = $questions->paginate($limit);

		foreach($questions as $question)
		{
			$arr['id']          = $question->id;
			$arr['description'] = $question->description;
			$arr['thumb']       = $question->getImageThumbFullUrl();
			$arr['image'] 	    = $question->getImageFullUrl();

			$answers = $question->answers;
			$arr['answers'] = [];
			foreach($answers as $answer)
			{
				$tmp = [];
				$tmp['id']			= $answer->id;
				$tmp['description'] = $answer->description;
				$tmp['is_correct']  = $answer->is_correct;
				array_push($arr['answers'], $tmp);
			}

			$arr['api_url']     = route('api.questions.show', [$application->api_key, $question->id]);

			array_push($output['data'], $arr);
		}

		$output['pages'] = $this->getApiPagerLinks($questions, 'api.questions', [$application->api_key]);

		return $output;
	}


	/**
	 * Find a single question
	 * @param  Integer $id 
	 * @return Array
	 */
	public function find($id)
	{
		$question = Question::findOrFail($id);
		$output = [];

		$output['id'] 			= $question->id;
		$output['description']  = $question->description;;
		$output['thumb']       	= $question->getImageThumbFullUrl();
		$output['image'] 		= $question->getImageFullUrl();

		$answers = $question->answers;
		$output['answers'] = [];
		foreach($answers as $answer)
		{
			$arr['id']			= $answer->id;
			$arr['description'] = $answer->description;
			$arr['is_correct']  = $answer->is_correct;
			array_push($output['answers'], $arr);
		}

		return $output;
	}
}