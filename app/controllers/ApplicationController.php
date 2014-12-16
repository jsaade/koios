<?php

class ApplicationController extends \BaseController {

	
	protected $application;

	public function __construct(Application $application)
	{
		$this->application = $application;
	}

	public function index()
	{		
		/*$token1 = strtolower('5EA48A318636BF011C8208ACC019697DE2C1BF238A73CE1F31F25D999EAFF865');
		$token2 = strtolower('1622F17A6D3C3C7FEE4A0F3D0540E3BAB0A987883B6BC1C36F137287B4FD9485');
		
		$devices = PushNotification::DeviceCollection(array(		    
		    PushNotification::Device($token1),
		    PushNotification::Device($token2)
		));

		$message = PushNotification::Message('Hi Zouzou',array(
		    'badge' => 1,


		    'locArgs' => array(
		        'arg1',
		        'arg2'
		    ),

		    'custom' => array('custom data' => array(
		        'we' => 'want', 'send to app'
		    ))
		));
		PushNotification::app('laf_IOS')
		                ->to($devices)
		                ->send($message);*/


		$clients = Client::with('applications')->has('applications')->get();
		return View::make('application.index')->with('clients' , $clients);
	}

	public function create()
	{
		$components = Component::all();
		$clients = Client::lists('name', 'id');
		return View::make('application.create')->with('components' , $components)->with('clients', $clients);
	}

	public function store()
	{
		$input = Input::all(); //post data
		$uploaded_image = Input::file('image');

		if($this->application->isValid($input))
		{
			//save the application
			$this->application = Application::create([
				'name' => $input['name'],
				'description' => $input['description'], 
				'client_id' => $input['client'], 
				'image' => '',
				'slug' => uniqid(),
				'api_key' => uniqid(),
				'api_secret' => hash('sha256', substr($input['name'],0,9), false)
			]);

			//upload the image if provided and save it in db
			if($uploaded_image)
			{
				$filename = $this->application->upload_image($uploaded_image);
				$this->application->update(['image' => $this->application->getUploadsRelativeUrl()."128-".$filename]);
			}
			
			//add the components to pivot table
			if($this->application->components())
				$this->application->components()->detach();
			if(isset($input['component']))
				$this->application->components()->attach($input['component']);
			
			return Redirect::route('application.index');
		}

		return Redirect::route('application.create')->withInput()->withErrors($this->application->errors);
	}

	public function show(Application $application)
	{
		View::share('showAppMenu',true);
		return View::make('application.show')->withApplication($application)->withFullcard(true);
	}

	public function edit(Application $application)
	{
		$this->application = $application;
		$components = Component::all();
		$clients = Client::lists('name', 'id');

		return View::make('application.edit')
			->with('components' , $components)
			->with('clients', $clients)
			->with('application', $this->application)
			->with('application_components', $this->application->components->lists('id'));
	}

	public function update(Application $application)
	{
		$this->application = $application;
		$input = Input::all(); //post data
		$uploaded_image = Input::file('image');

		if($this->application->isValid($input))
		{
			$this->application->update([
				'name' => $input['name'],
				'description' => $input['description'], 
				'client_id' => $input['client']
			]);

			//upload the image if provided and save it in db
			if($uploaded_image)
			{
				$filename = $this->application->upload_image($uploaded_image);
				$this->application->update(['image' => $this->application->getUploadsRelativeUrl()."128-".$filename]);
			}
			
			//add the components to pivot table
			if($this->application->components())
				$this->application->components()->detach();
			if(isset($input['component']))
				$this->application->components()->attach($input['component']);

			return Redirect::route('application.index');
		}
		return Redirect::route('application.edit', $application->slug)->withInput()->withErrors($this->application->errors);
	}

	public function destroy(Application $application)
	{
		//
	}

	public function certificates(Application $application)
	{
		$this->application = $application;
		$input = Input::all(); //post data
		$uploaded_cert = Input::file('ios_certificate');

		$this->application->update([
			'ios_password' => $input['ios_password'],
			'android_api_key' => $input['android_api_key'] 
		]);

		//upload the image if provided and save it in db
		if($uploaded_cert)
		{
			$filename = $this->application->upload_certificate($uploaded_cert);
			$this->application->update(['ios_certificate' => $filename]);
		}	

		$this->application->updateCertificatesConfig();
		return Redirect::route('application.show', $this->application->slug);	
	}

}