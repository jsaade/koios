<?php


class ApiController extends \BaseController {

	const HTTP_RESPONSE_OK = 200;
	const HTTP_CREATED = 201;
	const HTTP_NO_CONTENT = 204;
	const HTTP_BAD_REQUEST = 400; // game meta key not found in db
	const HTTP_UNAUTHORIZED = 401; //headers are wrong
	const HTTP_FORBIDDEN = 403; // subscriber or news does not belong to app
	const HTTP_NOT_FOUND = 404; //invalid request url
	const HTTP_METHOD_NOT_ALLOWED = 405; //GET and POST methods validation
	const HTTP_VALID_PARAMS = 449; //wrong post params
	const HTTP_TOKEN_INVALID = 498; //access token is wrong
	const HTTP_TOKEN_REQUIRED = 499; //access token not set

	
	public function respondOk($data, $message = "Response is ok!", $code = 200,  $headers = [])
	{
		return Response::json(
			['data' => [ 'code' => $code, 'message' => $message, 'content' => $data]], 
			self::HTTP_RESPONSE_OK, 
			$headers
		);
	}

	public function respondErrors($errors, $message = "", $code, $headers = [])
	{
		return Response::json(
			['data' => [ 'code' => $code, 'message' => $message, 'errors' => $errors] ], 
			200, //to handle the js console
			$headers
		);
	}
}