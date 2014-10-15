<?php

class DeveloperController extends \BaseController {

		
	public function api()
	{
		return View::make('developer.api');
	}

	public function console()
	{
		$url = URL::to('/')."/api/app/";
		return View::make('developer.console')->withUrl($url);
	}

}