<?php
namespace Acme\Repositories;
use Question;

class DbQuestionRepository
{
	/**
	 * Get all the questions of an application
	 * @param  Appliaction $application 
	 * @return Array
	 */
	public function getAll($application)
	{
		$output = array();
		$questions = $application->questions;

		foreach($questions as $question)
		{
			$arr['id'] = $question->id;
			$arr['description'] = $question->description;
			if($question->image)
				$arr['thumb'] = url($question->getImageThumbRelativeUrl());
			else
				$arr['thumb'] = null;
			array_push($output, $arr);
		}

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

		$output['id'] = $question->id;
		$output['description'] = $question->description;;
		if($question->image)
			$output['image'] = url($question->getImageRelativeUrl());
		else
			$output['image'] = null;

		$answers = $question->answers;
		$output['answers'] = [];
		foreach($answers as $answer)
		{
			$arr['description'] = $answer->description;
			$arr['is_correct'] = $answer->is_correct;
			array_push($output['answers'], $arr);
		}

		return $output;
	}
}