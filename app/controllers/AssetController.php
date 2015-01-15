<?php

class AssetController extends \BaseController {

	public function __construct(Asset $asset)
	{
		$this->asset = $asset;
		View::share('showAppMenu',true);
	}

	public function index(Application $application)
	{
		return View::make('asset.index')->withAssets($application->assets)->withApplication($application);
	}


	public function create(Application $application)
	{
		return View::make('asset.create')->withApplication($application);
	}

	
	public function store(Application $application)
	{
		$input = Input::all();
		$uploaded_file = Input::file('url');

		if($this->asset->isValid($input))
		{
			$input['type'] = $uploaded_file->getMimeType();
			$this->asset = Asset::create($input);
			
			$filename = $this->asset->upload_file($uploaded_file);
			$url     = $this->asset->getUploadsRelativeUrl().$filename;
			$this->asset->update(['url' => $url]);
			return Redirect::route('application.{application}.assets.index', $application->slug);
		}

		return Redirect::route('application.{application}.assets.create', $application->slug)
				->withInput()
				->withErrors($this->asset->errors);
	}

	
	public function destroy(Application $application, Asset $asset)
	{
		if(Request::ajax())
		{
			$asset->delete();
			$response = ['data' => "destroyed"];
		}
	}

}