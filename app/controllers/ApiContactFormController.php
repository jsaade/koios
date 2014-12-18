<?php

class ApiContactFormController extends \ApiController {

	
	public function storeValues(Application $application, ContactForm $contact_form)
	{
		$input = Input::all();
		$input['contact_form_id'] = $contact_form->id;
		$contactValues = new ContactValues();

		if($contactValues->isValid($input))
		{
			 $contact_value = ContactValues::create($input);
			 return $this->respondOk(['contactValueId' => $contact_value->id],'Contact values were created successfully.', self::HTTP_CREATED);
		}
		return $this->respondErrors( $contactValues->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}


	public function storeAttachements(Application $application, ContactForm $contact_form, $contact_values_id)
	{
		$uploaded_images = Input::file('attachment');
		if(!count($uploaded_images))
			return $this->respondErrors( ['attachment' => 'the attachement field is required'], "Retry with valid parameters", self::HTTP_VALID_PARAMS);

		foreach($uploaded_images as $uploaded_image)
		{
			$type = $uploaded_image->getMimeType();
			$contact_attachment = ContactAttachments::create(
				['contact_form_id' => $contact_form->id, 'contact_values_id' => $contact_values_id]
			);
			//uplaod the file 
			$filename = $contact_attachment->upload_attachment($uploaded_image);
			//update the database
			$url  = $contact_attachment->getUploadsRelativeUrl().$filename;
			$contact_attachment->update(['url' => $url, 'type' => $type]);
		}

		return $this->respondOk([],'Attachment were created successfully.', self::HTTP_CREATED);
	}



}