<?php

class Subscriber extends \Eloquent {
	protected $table = 'subscriber';
	protected $fillable = ['username', 'email', 'password', 'is_verified', 'verification_token', 'application_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'username'    => 'required|username_unique_per_app',
		'email'       => 'required|email|email_unique_per_app',
		'password'    => 'required|min:8',
		'is_verified' => 'required'
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