<?php

class Asset extends \Eloquent {
	protected $table = 'asset';
	protected $fillable = ['name', 'caption', 'type', 'url', 'application_id'];

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
		'url'  => 'required'
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

	/***************
	 * FILE UPLOAD *
	 ***************/
	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->application->slug."/assets/";
	}

	public function getAssetFullUrl()
	{
		if($this->url)
			return url($this->url);

		return null;
	}

	public function getUploadsPath()
	{
		$path = uploads_path()."/".$this->application->slug."/";
		File::exists($path) or File::makeDirectory($path);
		$path .= "assets/";
		File::exists($path) or File::makeDirectory($path);
		return $path;
	}

	public function upload_file($uploaded_file)
	{
		$destinationPath = $this->getUploadsPath();
		$filename = $uploaded_file->getClientOriginalName();
		
		$uploaded_file->move($destinationPath, $filename);
		return $filename;
	}


	public function removeAsset()
	{
		if($this->url)
		{
			$asset_path = public_path()."/".$this->url;
			File::delete($asset_path);
			$this->update(['url' => '']);
		}
	}

}