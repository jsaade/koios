<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\Input as Input;

class SecureFilter
{
	/*
	 * For each api request, the header auth-token should be the md5() of api_secret + param values
	 */
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
		$input = Input::all();
		$str_input = "";
		$console = false;

		//get the sent token
		$auth_token = $request->header('X-Auth-Token');
		//validate the token
		$secret = $app->api_secret;
		//if(count($input))
		//	$str_input .= implode("", $input);

		$encrypted_secret = md5($secret.$str_input);

		//skip the filter if it is coming from the console and the user is loggedin
		if($auth_token == "console" && !Auth::guest())
		{
			$console = true;
		}

		if(!$console && (!$auth_token || ($auth_token != $encrypted_secret)))
			return Response::make(
	   			['code' => 401, 
	   			'message' => "Unauthorized | You don't have permission to perform this request."]
	   		);
	}
}

?>