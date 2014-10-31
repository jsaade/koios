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

	public function getImageThumbRelativeUrl()
	{
		return $this->getUploadsRelativeUrl()."30-".$this->image;
	}

	public function getImageRelativeUrl()
	{
		return $this->getUploadsRelativeUrl().$this->image;
	}


	public function getImageThumbFullUrl()
	{
		if($this->image)
			return url($this->getUploadsRelativeUrl()."30-".$this->image);

		return null;
	}

	public function getImageFullUrl()
	{
		if($this->image)
			return url($this->getUploadsRelativeUrl().$this->image);

		return null;
	}


	public function uploadImage($uploaded_image)
	{
		
		$filename = NULL;
		if($uploaded_image)
		{
			$image = Image::make($uploaded_image->getRealPath()); 
			$filename = $uploaded_image->getClientOriginalName();
			$image->save($this->getUploadsPath().$filename)
				  ->resize(30, 30)
				  ->save($this->getUploadsPath()."30-".$filename);

			$this->update(['image' => $filename]);
		}
		return $filename;
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