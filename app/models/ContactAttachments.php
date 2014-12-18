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


	public function getUploadsRelativeUrl()
	{
		return uploads_relative_url().$this->contactForm->application->slug."/contact/".$this->id."/";
	}

	public function getUploadsPath()
	{
		$path = uploads_path()."/".$this->contactForm->application->slug."/";
		File::exists($path) or File::makeDirectory($path);
		$path .= "contact/";
		File::exists($path) or File::makeDirectory($path);
		$path .= $this->id."/";
		File::exists($path) or File::makeDirectory($path);
		return $path;
	}

	public function upload_attachment($uploaded_image)
	{
		$destinationPath = $this->getUploadsPath();
		$filename = $uploaded_image->getClientOriginalName();
		
		$uploaded_image->move($destinationPath, $filename);
		return $filename;
	}
}