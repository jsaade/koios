<?php

class Device extends \Eloquent {
	protected $table = 'device';
	protected $fillable = ['model', 'os', 'version', 'token', 'subscriber_id'];

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'model'  => 'required',
		'os'     => 'required',
		'token'  => 'required',
		'subscriber_id' => 'required|exists:subscriber,id'
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