<?php

class ContactForm extends \Eloquent {
	protected $table = 'contact_form';
	protected $fillable = ['name', 'email'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
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
		'email' => 'required|email'
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