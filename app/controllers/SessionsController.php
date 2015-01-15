<?php

class SessionsController extends \BaseController {

	public function create()
	{
		return View::make('sessions.create');
	}

	public function store()
	{
		$input =  Input::all();
		
		$attempt = Auth::attempt([
			'username' => $input['username'],
			'password' => $input['password']
		]);

		if($attempt)
			return Redirect::intended("/");

		return Redirect::back()->withInput()->withErrors("Invalid login credentials.");
	}

	/**
	 * Logout User
	 * @return [type] [description]
	 */
	public function destroy()
	{
		Auth::logout();
		return Redirect::home();
	}

	/**
	 * Activate the subscriber of the app upon signup
	 * @return [type] [description]
	 */
	public function activate()
	{
		$input =  Input::all();
		$code  =  $input['code'];
		$subscriber = Subscriber::where('verification_token' , $code)->first();
		
		if(!$subscriber)
			return Response::make(['message' => 'Invalid code.']);

		$subscriber->update(['access_token' => md5($subscriber->email.uniqid()), 'is_verified' => 1]);
		return View::make('emails.activation_ok')->withSubscriber($subscriber);
	}

	/**
	 * Let's the subscriber update this password
	 * @return [type] [description]
	 */
	public function forgotPassword()
	{
		$input =  Input::all();
		$code  =  $input['code'];
		$subscriber = Subscriber::where('verification_token' , $code)->first();
		
		if(!$subscriber)
			return Response::make(['message' => 'Invalid code.']);

		return View::make('emails.password_form')->withSubscriber($subscriber);
	}

	/**
	 * Stores the new password of the subscriber
	 * @return [type] [description]
	 */
	public function storePassword()
	{
		$input =  Input::all();
		$code  =  $input['code'];
		$password  =  $input['password'];
		$subscriber = Subscriber::where('verification_token' , $code)->first();

		if(!$password)
			return Redirect::route('reset.password', ['code' => $subscriber->verification_token]);

		$subscriber->update(['password' => Hash::make($password) ]);
		return View::make('emails.password_ok');
	}

}