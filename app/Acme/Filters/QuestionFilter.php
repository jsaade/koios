<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class QuestionFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
	   	$question = $route->getParameter('questions');
	   	
	   	if( $app->id != $question->application_id)
	   		return Response::make(
	   			['code' => 403, 
	   			'message' => "Forbidden | The specified question does not belong to this application"]
	   		);
	}
}