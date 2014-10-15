<?php


class ApiController extends \BaseController {

	const HTTP_VALID_PARAMS = 409;
	const HTTP_RESPONSE_OK = 200;

	
	public function respondOk($data, $message = "Response is ok!", $headers = [])
	{
		return Response::json(
			['data' => [ 'status' => self::HTTP_RESPONSE_OK, 'message' => $message, 'content' => $data]], 
			self::HTTP_RESPONSE_OK, 
			$headers
		);
	}

	public function respondErrors($erros, $message = "", $status, $headers = [])
	{
		return Response::json(
			['data' => [ 'status' => $status, 'message' => $message, 'errors' => $erros] ], 
			200, //to handle the js console
			$headers
		);
	}
}