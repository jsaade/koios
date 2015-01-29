<?php

class Question extends \Eloquent {
	protected $fillable = ['description', 'image', 'application_id'];
	protected $table = 'question';

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function application()
	{
		return $this->belongsTo('Application');
	}

	public function answers()
	{
		return $this->hasMany('Answer');
	}

	public function questions_subscribers()
	{
		return $this->hasMany('QuestionSubscriber');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'description' => 'required|answers_required|correct_answer_required', 
		'application_id' => 'required|exists:application,id'
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
		$path = uploads_path().$this->application->slug."/";
		File::exists($path) or File::makeDirectory($path);
		$path .= "questions/";
		File::exists($path) or File::makeDirectory($path);
		$path .= $this->id."/";
		File::exists($path) or File::makeDirectory($path);
		return $path;
	}

	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->application->slug."/questions/".$this->id."/";
	}


	/** Relative URLs **/

	public function getImageRelativeUrl()
	{
		return $this->getUploadsRelativeUrl().$this->image;
	}

	public function getImageThumbRelativeUrl()
	{
		return $this->getUploadsRelativeUrl()."thumb-".$this->image;
	}


	/** Relative Full URLs **/

	public function getImageThumbFullUrl()
	{
		if($this->image)
			return url($this->getUploadsRelativeUrl()."thumb-".$this->image);

		return null;
	}

	public function getImageFullUrl()
	{
		if($this->image)
			return url($this->getUploadsRelativeUrl().$this->image);

		return null;
	}


	/** Upload Image **/

	public function uploadImage($uploaded_image)
	{
		
		$filename = NULL;
		if($uploaded_image)
		{
			$application = $this->application;
			$image = Image::make($uploaded_image->getRealPath()); 
			$filename = $uploaded_image->getClientOriginalName();
			$image->save($this->getUploadsPath().$filename);

			//resize tumb
			if($application->question_resize_width || $application->question_resize_height)
			{
				$image->resize($application->question_resize_width, $application->question_resize_height, function ($constraint) {
			    	$constraint->aspectRatio();
				});
			}
			//crop thumb
			if($application->question_crop_width || $application->question_crop_height)
			{
				$image->crop($application->question_crop_width ,$application->question_crop_height);
			}
			//save thumb	  
			$image->save($this->getUploadsPath()."thumb-".$filename);
			

			$this->update(['image' => $filename]);
		}
		return $filename;
	}


	/** Remove Image **/
	public function removeImage()
	{
		if($this->image)
		{
			$image_path = $this->getUploadsPath().$this->image;
			$thumb_path = $this->getUploadsPath()."thumb-".$this->image;
			File::delete($image_path);
			File::delete($thumb_path);
			$this->update(['image' => '']);
		}
	}


	/******************
	 * CREATE ANSWERS *
	 ******************/

	public function createOrUpdateAnswers($input)
	{
		$answers = get_keys_startingwith_as_subarray($input, 'answer_description');
		$correct = $input['answer_is_correct'];
		if(isset($input['_method']) && $input['_method'] == "PATCH")
		{
			foreach($this->answers as $key => $answer)
			{
				$key = str_replace('answer_description_', '', $key);
				$answer->update([
					'description' => $answers['answer_description_'.$answer->id],
					'is_correct' => ($correct == $key)?true:false
				]);
			}
		}
		else
		{
			foreach($answers as $key => $val)
			{
				var_dump($correct, $key);
				$answer = new Answer;
				$answer->description = $val;
				$answer->is_correct = ('answer_description_'.$correct == $key)?true:false;
				$answer->question()->associate($this);
				$answer->save();
			}
		}
	}
}