<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class SecureFilter
{
	public function filter($route, $request)
	{
		$app = $route->getParameter('app');
		//dd($app->id); //compare the bearer
	}
}

?>