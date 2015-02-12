<?php

class Device extends \Eloquent {
	protected $table = 'device';
	protected $fillable = ['model', 'os', 'version', 'token', 'subscriber_id', 'application_id', 'uid'];

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'model'  => 'required',
		'os'     => 'required',
		'uid'    => 'required',
		'token'  => 'required|device_token_unique_per_subscriber',
		'subscriber_id' => 'required|exists:subscriber,id'
	];

	public function isValid($data, $rules = null)
	{
		if(!$rules)
			$rules = static::$rules;

		$validation = Validator::make($data, $rules );
		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

	/*******************
	 * MODEL OBSERVERS *
	 *******************/
	public static function boot()
	{
		parent::boot();
		Device::observe(new \Acme\Observers\DeviceObserver);
	}
}