<?php

class Application extends \Eloquent {
	protected $table = 'application';
	protected $fillable = ['name', 'description', 'image', 'slug', 'api_key', 'api_secret', 'client_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function client()
	{
		return $this->belongsTo('Client');
	}

	public function components()
	{
		return $this->belongsToMany('Component');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'name' => 'required',
		'client' => 'required|exists:client,id'
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

	/***********
	 * UPLOADS *
	 ***********/
	public function getUploadsPath()
	{
		$path = uploads_path().$this->slug."/";
		File::exists($path) or File::makeDirectory($path);
		
		return $path;
	}

	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->slug."/";
	}

	public function getImageRelativeUrl()
	{
		if($this->image)
			return $this->getUploadsRelativeUrl().$this->image;

		return NULL;
	}
}