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

	/****************
	 * IMAGE UPLOAD *
	 ****************/
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

	public function upload_image($uploaded_image)
	{
		$image = Image::make($uploaded_image->getRealPath()); 
		$filename = $uploaded_image->getClientOriginalName();
		$image->save($this->getUploadsPath().$filename)
			  ->resize(128, 128)
			  ->save($this->getUploadsPath()."128-".$filename);

		return $filename;
	}
}