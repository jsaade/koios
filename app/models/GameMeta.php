<?php

class GameMeta extends \Eloquent {
	protected $table = 'game_meta';
	protected $fillable = ['meta_key', 'meta_value', 'subscriber_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function subscriber()
	{
		return $this->belongsTo('Subscriber');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'meta_key'      => 'required|alpha_dash|metakey_unique_per_subscriber',
		'meta_value'    => 'required',
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