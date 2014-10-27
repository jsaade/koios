<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class SubscriberFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
	   	$subscriber = $route->getParameter('subscribers');
	   	
	   	if( $app->id != $subscriber->application_id)
	   		return Response::make(
	   			['code' => 403, 
	   			'message' => "Forbidden | The specified subscriber does not belong to this application"]
	   		);
	}
}
?>