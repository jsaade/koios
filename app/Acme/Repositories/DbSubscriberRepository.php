<?php
namespace Acme\Repositories;
use Subscriber;
use SubscriberProfile;
use Illuminate\Support\Facades\Hash as Hash;

class DbSubscriberRepository extends DbRepos
{
	public function create($input)
	{
		$input['password'] = Hash::make($input['password']);
		//create the subscriber
		$subscriber = Subscriber::create([
			'username'    		 => $input['username'],
			'email'       		 => $input['email'],
			'password' 	  		 => $input['password'],
			'is_verified' 		 => $input['is_verified'],
			'verification_token' => hash('sha256', substr($input['username'],0,9), false),
			'application_id'     => $input['application_id']
		]);

		return $subscriber;
	}

	public function createProfile($input)
	{
		//create the subscriber
		$subscriber = SubscriberProfile::create($input);
		return $subscriber;
	}
}