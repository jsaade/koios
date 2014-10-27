<?php

class Subscriber extends \Eloquent {
	protected $table = 'subscriber';
	protected $fillable = ['username', 'email', 'password', 'is_verified', 'verification_token', 'access_token','application_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function devices()
	{
		return $this->hasMany('Device');
	}

	public function profile()
	{
		return $this->hasOne('SubscriberProfile');
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
		'username'      => 'required|username_unique_per_app',
		'email'       	=> 'required|email|email_unique_per_app|facebook_id_or_password_required',
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