<?php

class ApplicationController extends \BaseController {

	
	protected $application;

	public function __construct(Application $application)
	{
		$this->application = $application;
	}

	public function index()
	{		
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
				'api_key' => uniqid().uniqid(),
				'api_secret' => Hash::make($input['name'])
			]);

			//upload the image if provided
			if($uploaded_image)
			{
				$image = Image::make($uploaded_image->getRealPath()); 
				$filename = $uploaded_image->getClientOriginalName();
				$image->save($this->application->getUploadsPath().$filename)
					  ->resize(128, 128)
					  ->save($this->application->getUploadsPath()."128-".$filename);

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

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update($id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}

}