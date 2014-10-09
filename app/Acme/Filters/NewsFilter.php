<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class NewsFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
	   	$news = $route->getParameter('news');
	   	
	   	if( $app->id != $news->application_id)
	   		return Response::make(
	   			['code' => 403, 
	   			'message' => "Forbidden | The specified news does not belong to this application"]
	   		);
	}
}
?>