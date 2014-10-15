<?php namespace Acme\ApiParser;

class SubscriberApiParser extends ApiParser 
{

	public function parse($subscriber)
	{
		//common fields between methods in the news repos
		$output = [
			'id'         => (int) $subscriber['id'],
			'username'   => $subscriber['username'],
			'email'		 => $subscriber['email'],
			'verified'   => (bool) $subscriber['is_verified']
		];

		if(array_key_exists('application', $subscriber))
	 		$output['application'] = $subscriber['application'];

		if(array_key_exists('devices', $subscriber))
	 		$output['devices'] = $this->parseDevices( $subscriber['devices'] );

		if(array_key_exists('profile', $subscriber))
	 		$output['profile'] = $this->parseProfile( $subscriber['profile'] );
	 		
	 	if(array_key_exists('api_url', $subscriber))
	 		$output['url'] = $subscriber['api_url'];

		return $output;
	}


	public function parseProfile($profile)
	{
		$profiles = [];

		if(!count($profile))
			return [];

		array_push($profiles, $profile);

		return array_map( function($profile){
			return [
				'firstName'    => $profile['first_name'],
				'lastName'     => $profile['last_name'], 
				'image'   		=> $profile['image'], 
				'facebookId'   => (int)$profile['facebook_id'], 
			];
		}, $profiles);
	}

	public function parseDevices($devices)
	{
		return array_map( function($device){
			return [
				'model'     => $device['model'],
				'os'        => $device['os'], 
				'version'   => $device['version'], 
				'token'     => $device['token'], 
			];
		}, $devices);
	}

}

