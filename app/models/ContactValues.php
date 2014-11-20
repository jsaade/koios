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
}