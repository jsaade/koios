<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;
use Illuminate\Support\Facades\Input as Input;

class AccessTokenFilter
{
	public function filter($route, $request)
	{
	   	$subscriber = $route->getParameter('subscribers');
	   	$input = Input::all();
	   	
	   	if(!isset($input['access_token']))
	   		return Response::make(
	   			['code' => 499, 
	   			'message' => "Token required | The access token is not set."]
	   		);

	    if(!$subscriber->access_token || $input['access_token'] != $subscriber->access_token)
	   		return Response::make(
	   			['code' => 498, 
	   			'message' => "Token invalid | The access token is invalid."]
	   		);
	}
}
?>