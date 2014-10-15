<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;
use Illuminate\Support\Facades\Auth as Auth;

class SecureFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
		
		$token = $request->header('X-Auth-Token');
		$console = false;
		$secret = $app->api_secret;

		//skip the filter if it is coming from the console and the user is loggedin
		if($token == "console" && !Auth::guest())
		{
			$console = true;
		}

		if(!$console && (!$token || ($token != $secret)))
			return Response::make(
	   			['code' => 401, 
	   			'message' => "Unauthorized | You don't have permission to perform this request."]
	   		);
	}
}

?>