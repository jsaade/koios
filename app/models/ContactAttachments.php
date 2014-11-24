<?php

class ContactAttachments extends \Eloquent {
	protected $table = 'contact_attachments';
	protected $fillable = ['type', 'url', 'contact_form_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function contactForm()
	{
		return $this->belongsTo('ContactForm');
	}
}