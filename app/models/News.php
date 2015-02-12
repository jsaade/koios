<?php

class News extends \Eloquent {
	protected $table = 'news';
	protected $fillable = ['name', 'description', 'caption', 'image', 'application_id', 'news_category_id', 'push_status'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function newsCategory()
	{
		return $this->belongsTo('NewsCategory');
	}



	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'name' => 'required',
		'description' => 'required',
		'news_category_id' => 'required|exists:news_category,id'
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


	/*******************
	 * MODEL OBSERVERS *
	 *******************/
	public static function boot()
	{
		parent::boot();
		News::observe(new \Acme\Observers\NewsObserver);
	}


	/****************
	 * IMAGE UPLOAD *
	 ****************/
	public function getUploadsPath()
	{
		$path = uploads_path().$this->newsCategory->application->slug."/";
		File::exists($path) or File::makeDirectory($path);
		$path .= "news/";
		File::exists($path) or File::makeDirectory($path);
		$path .= $this->id."/";
		File::exists($path) or File::makeDirectory($path);
		return $path;
	}

	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->newsCategory->application->slug."/news/".$this->id."/";
	}


	/** Relative URLs **/

	public function getImageRelativeUrl()
	{
		if($this->image)
			return $this->getUploadsRelativeUrl().$this->image;

		return null;
	}

	public function getImageThumbRelativeUrl()
	{
		if($this->image)
		 	return $this->getUploadsRelativeUrl()."thumb-".$this->image;
		
		return null;
	}


	/** Full URLs **/

	public function getImageFullUrl()
	{
		if($this->image)
			return url($this->getUploadsRelativeUrl().$this->image);

		return null;
	}


	public function getImageThumbFullUrl()
	{
		if($this->image)
		 	return url($this->getUploadsRelativeUrl()."thumb-".$this->image);
		
		return null;
	}


	/** Upload Image file **/

	public function uploadImage($uploaded_image)
	{
		
		$filename = NULL;
		if($uploaded_image)
		{
			$application = $this->newsCategory->application;
			$image = Image::make($uploaded_image->getRealPath()); 
			$filename = $uploaded_image->getClientOriginalName();
			$image->save($this->getUploadsPath().$filename);
			//resize tumb
			if($application->news_resize_width || $application->news_resize_height)
			{
				$image->resize($application->news_resize_width, $application->news_resize_height, function ($constraint) {
			    	$constraint->aspectRatio();
				});
			}
			//crop thumb
			if($application->news_crop_width || $application->news_crop_height)
			{
				$image->crop($application->news_crop_width ,$application->news_crop_height);
			}
			//save thumb	  
			$image->save($this->getUploadsPath()."thumb-".$filename);
		}
		return $filename;
	}


	/** Remove Image file **/
	public function removeImage()
	{
		if($this->image)
		{
			$image_path = $this->getUploadsPath().$this->image;
			$thumb_path = $this->getUploadsPath()."thumb-".$this->image;
			File::delete($image_path);
			File::delete($thumb_path);
		}
	}
}