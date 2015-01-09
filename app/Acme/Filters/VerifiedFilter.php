<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class VerifiedFilter
{
	public function filter($route, $request)
	{
	   	$subscriber = $route->getParameter('subscribers');

	    if(!$subscriber->is_verified)
	   		return Response::make(
	   			['code' => 401, 
	   			'message' => "Unauthorized | The subscriber is not verified."]
	   		);
	}
}
?>