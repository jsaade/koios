<?php

class NewsCategory extends \Eloquent {
	protected $table = 'news_category';
	protected $fillable = ['name', 'application_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function news()
	{
		return $this->hasMany('News');
	}

	public function application()
	{
		return $this->belongsTo('Application');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'name' => 'required',
		'application_id' => 'required|exists:application,id'
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