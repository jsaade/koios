<?php

class ContactFormController extends \BaseController {

	protected $contact_form;

	public function __construct(ContactForm $contact_form)
	{
		$this->contact_form = $contact_form;
		View::share('showAppMenu',true);
	}


	public function index(Application $application)
	{
		$contact_forms = $application->contact_forms;
		return View::make('contact_forms.index')->withApplication($application)->withContactForms($contact_forms);
	}


	public function create(Application $application)
	{
		return View::make('contact_forms.create')->withApplication($application);
	}


	public function store(Application $application)
	{
		$input = Input::all();
		if($this->contact_form->isValid($input))
		{
			$this->contact_form = ContactForm::create($input);
			return Redirect::route('application.{application}.contact-forms.index', $application->slug);
		}

		return Redirect::route('application.{application}.contact-forms.create', $application->slug)
				->withInput()
				->withErrors($this->contact_form->errors);
	}

	
	public function show($id)
	{
		//
	}

	
	public function edit(Application $application, ContactForm $contact_form)
	{
		return View::make('contact_forms.edit')->withApplication($application)->withContactForm($contact_form);
	}

	
	public function update(Application $application, ContactForm $contact_form)
	{
		$input = Input::all();
		$this->contact_form = $contact_form;

		if($this->contact_form->isValid($input))
		{
			$this->contact_form->update($input);
			return Redirect::route('application.{application}.contact-forms.index', $application->slug);
		}

		return Redirect::route('application.{application}.contact-forms.edit', [$application->slug, $this->contact_form->id])
				->withInput()
				->withErrors($this->contact_form->errors);
	}

	
	public function destroy(Application $application, ContactForm $contact_form)
	{
		if(Request::ajax())
		{
			$contact_form->delete();
			$response = ['data' => "destroyed"];
		}
	}

}