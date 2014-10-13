<?php

class DeveloperController extends \BaseController {

	public function console()
	{
		$url = URL::to('/')."/api/app/";
		$action = action('DeveloperController@response');
		return View::make('developer.console')->withUrl($url)->withAction($action);
	}

	public function response()
	{
		$input = Input::All();
		
		//build the api url, find the app to pass the api_secret
		$uri = $input['uri'];
		$uri_parts = explode("/", $uri);
		$api_key = $uri_parts[0];

		$app = Application::where('api_key', $api_key)->first();
		
		//$request = URL::to('/')."/api/app/".$uri;
		//for local testing, make a checkbox in the interface
		$request = "http://localhost:80/koios/public/index.php/api/app/".$uri;
		
		$ch = curl_init();
		$headers = array('X-Auth-Token: '.$app->api_secret, 'Content-Type: application/json', 'Accept: application/json'); 
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt($ch, CURLOPT_URL, $request);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($ch);
		curl_close($ch);
		return $resp;
	}

}