<?php namespace Acme\ApiParser;

class SubscriberApiParser extends ApiParser 
{

	public function parse($subscriber)
	{
		//common fields between methods in the news repos
		$output = [ 'id' => (int) $subscriber['id'], 'username' => $subscriber['username'] ];

		if(array_key_exists('email', $subscriber))
	 		$output['email'] = $subscriber['email'];

	 	if(array_key_exists('facebook_id', $subscriber))
	 		$output['facebook_id'] = (int)$subscriber['facebook_id'];

		if(array_key_exists('is_verified', $subscriber))
	 		$output['verified'] = (bool) $subscriber['is_verified'];	 			 	

		if(array_key_exists('application', $subscriber))
	 		$output['application'] = $subscriber['application'];

		if(array_key_exists('devices', $subscriber))
	 		$output['devices'] = $this->parseDevices( $subscriber['devices'] );

	 	if(array_key_exists('score', $subscriber))
	 		$output['score'] = (int) $subscriber['score'];

	 	if(array_key_exists('level', $subscriber))
	 		$output['level'] = (int) $subscriber['level'];	

	 	if(array_key_exists('meta_value', $subscriber))
	 		$output['meta_value'] = $subscriber['meta_value']; 	

	 	if(array_key_exists('metas', $subscriber))
	 		$output['metas'] = $subscriber['metas'];

		if(array_key_exists('profile', $subscriber))
	 		$output['profile'] = $this->parseProfile( $subscriber['profile'] );
	 		
	 	if(array_key_exists('api_url', $subscriber))
	 		$output['url'] = $subscriber['api_url'];

	 	if(array_key_exists('game_info', $subscriber))
	 		$output['game_info'] = $this->parseGameInfo( $subscriber['game_info'] );

	

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
				'image'   		=> $profile['image'] 
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


	public function parseGameInfo($game_info)
	{
		return [ 
			'score' => (int) $game_info['score'],
			'level' => (int) $game_info['level'],
			'metas' => $game_info['metas']
		];
	}


}

