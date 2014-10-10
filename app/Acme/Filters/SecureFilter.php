<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class SecureFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
		
		$token = $request->header('X-Auth-Token');
		$secret = $app->api_secret;

		if(!$token || ($token != $secret))
			return Response::make(
	   			['code' => 401, 
	   			'message' => "Unauthorized | You don't have permission to perform this request."]
	   		);
	}
}

?>