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
	   	
	   if( !isset($input['access_token']) || $input['access_token'] != $subscriber->access_token)
	   		return Response::make(
	   			['code' => 498, 
	   			'message' => "Invalid Token | The access token is invalid or not set"]
	   		);
	}
}
?>