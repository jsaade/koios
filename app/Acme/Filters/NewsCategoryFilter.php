<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class NewsCategoryFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
   		$news_category = $route->getParameter('news_categories');
   	
   		if( $app->id != $news_category->application_id)
   			return Response::make(['code' => 403, 'message' => "Forbidden | The specified news category does not belong to this application"]);
   	}
}

?>