<?php

namespace Acme\Filters;
use Illuminate\Support\Facades\Response as Response;

class ContactFormFilter
{
	public function filter($route, $request)
	{
		$app         = $route->getParameter('app');
	   	$contactForm = $route->getParameter('contact_forms');
	   	
	   	if( $app->id != $contactForm->application_id)
	   		return Response::make(
	   			['code' => 403, 
	   			'message' => "Forbidden | The specified contact form does not belong to this application"]
	   		);
	}
}
?>