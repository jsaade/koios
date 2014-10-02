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

	public function destroy()
	{
		Auth::logout();
		return Redirect::home();
	}

}