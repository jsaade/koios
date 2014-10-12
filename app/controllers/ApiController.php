<?php


class ApiController extends \BaseController {

	
	public function respondOk($data, $headers = [])
	{
		return Response::json(['data' => [ 'status' => 200, 'content' => $data]], 200, $headers);
	}

	
}