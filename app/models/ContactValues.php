<?php

class ContactValues extends \Eloquent {
	protected $table = 'contact_values';
	protected $fillable = ['name', 'email', 'phone', 'message', 'contact_form_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function contactForm()
	{
		return $this->belongsTo('ContactForm');
	}

	public function contactAttachments()
	{
		return $this->hasMany('ContactAttachments');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [ 
		'message' => 'required'
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