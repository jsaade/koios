<?php

class SubscriberProfile extends \Eloquent {
	protected $fillable = ['first_name', 'last_name', 'image', 'facebook_id', 'subscriber_id'];
	protected $table = 'subscriber_profile';

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'first_name'    => 'required',
		'last_name'     => 'required'
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