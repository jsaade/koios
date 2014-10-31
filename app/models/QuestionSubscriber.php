<?php

class QuestionSubscriber extends \Eloquent {
	protected $table = 'question_subscriber';
	protected $fillable = ['question_id', 'subscriber_id', 'answer_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function question()
	{
		return $this->belongsTo('Question');
	}

	public function subscriber()
	{
		return $this->belongsTo('Subscriber');
	}


	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'question_id' => 'required|exists:question,id', 
		'subscriber_id' => 'required|exists:subscriber,id',
		'answer_id' => 'required|exists:answer,id',
	];

	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);
		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}
}