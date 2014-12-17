<?php
namespace Acme\Repositories;
use Subscriber;
use SubscriberProfile;
use Device;
use DB;
use Illuminate\Support\Facades\Hash as Hash;

class DbSubscriberRepository extends DbRepos
{

	/**
	 * Gets all the application verfied subscribers
	 * @param  [type] $application [description]
	 * @param  [type] $limit       [description]
	 * @param  [type] $page        [description]
	 * @return [type]              [description]
	 */
	public function getAll($application, $limit, $page)
	{
		$output = ['data' => [], 'pages' => []];
		
		if(!$limit) $limit = 25;
		if(!$page) $page = 1;

		$subscribers = $application->subscribers()->paginate($limit);
		foreach($subscribers as $subscriber)
		{
			$arr['id']			= $subscriber->id;
			$arr['email'] 		= $subscriber->email;
			$arr['username'] 	= $subscriber->username;
			$arr['is_verified'] = $subscriber->is_verified;
			$arr['api_url']  = route('api.subscribers.show', [$application->api_key, $subscriber->id]);
			array_push($output['data'], $arr);
		}
		$output['pages'] = $this->getApiPagerLinks($subscribers, 'api.subscribers', [$application->api_key]);
		return $output;
	}



	/**
	 * Find a single subscriber
	 * @param  Integer $id 
	 * @return Array
	 */
	public function find($id)
	{
		$subscriber = Subscriber::with('devices')->with('profile')->with('game_metas')->findOrFail($id);
		$output = [];

		$output['id']			= $subscriber->id;
		$output['email'] 		= $subscriber->email;
		$output['username'] 	= $subscriber->username;
		$output['facebook_id'] 	= $subscriber->facebook_id;
		$output['is_verified']  = $subscriber->is_verified;
		$output['application']  = $subscriber->application->name;

		$output['profile'] = [];
		if($subscriber->profile)
		{
			$output['profile']['first_name'] = $subscriber->profile->first_name;
			$output['profile']['last_name'] = $subscriber->profile->last_name;
			$output['profile']['image'] = $subscriber->profile->image;
			$output['profile']['facebook_id'] = $subscriber->profile->facebook_id;
		}
		

		$output['devices'] = [];
		if($subscriber->devices)
		{
			foreach($subscriber->devices as $device)
			{
				$arr['model']     = $device->model;
				$arr['os']        = $device->os;
				$arr['version']   = $device->version;
				$arr['token']     = $device->token;
				array_push($output['devices'], $arr);
			}
		}

		$output['game_info'] = [];
		$output['game_info']['score']  = $subscriber->score;
		$output['game_info']['level']  = $subscriber->level;

		$output['game_info']['metas'] = [];
		if(count($subscriber->game_metas))
		{
			$arr = [];
			foreach($subscriber->game_metas as $meta)
			{
				$arr[$meta->meta_key] = $meta->meta_value;
			}
			array_push($output['game_info']['metas'], $arr);
		}
		

		return $output;
	}



	/**
	 * Creates a subscriber
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	public function create($input)
	{
		$password    =  (isset($input['password']))?Hash::make($input['password']):"";
		$facebook_id =  (isset($input['facebook_id']))?$input['facebook_id']:"";
		//$is_verified  = (isset($input['facebook_id']))?1:0;
		$is_verified  = 1;
		$access_token =  ($is_verified==1)?md5($input['email'].uniqid()):"";
		
		$subscriber = Subscriber::create([
			'username'    		 => $input['username'],
			'email'       		 => $input['email'],
			'facebook_id'        => $facebook_id,
			'password' 	  		 => $password,
			'is_verified' 		 => $is_verified,
			'access_token'       => $access_token,
			'verification_token' => hash('sha256', substr($input['username'],0,9), false),
			'application_id'     => $input['application_id']
		]);

		return $subscriber;
	}



	/**
	 * Creates a subscriber profile
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	public function createProfile($input)
	{
		$subscriberProfile = SubscriberProfile::create($input);
		return $subscriberProfile;
	}



	/**
	 * Creates a subscriber device
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	public function createDevice($input)
	{
		$device = Device::create($input);
		return $device;
	}



	/**
	 * Updates the subscriber score and level
	 * @param  [type] $input      [description]
	 * @param  [type] $subscriber [description]
	 * @return [type]             [description]
	 */
	public function update($input, $subscriber)
	{
		$subscriber->score = $input['score'];
		$subscriber->level = $input['level'];
		$subscriber->save();
		return $subscriber;
	}


	/**
	 * Get a subscriber gaming info
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function getGameInfo($id)
	{
		$subscriber = Subscriber::with('game_metas')->findOrFail($id);
		$output = [];

		$output['id']			= $subscriber->id;
		$output['username'] 	= $subscriber->username;
		$output['score']  = $subscriber->score;
		$output['level']  = $subscriber->level;

		$output['metas'] = [];
		if(count($subscriber->game_metas))
		{
			$arr = [];
			foreach($subscriber->game_metas as $meta)
			{
				$arr[$meta->meta_key] = $meta->meta_value;
			}
			array_push($output['metas'], $arr);
		}
		
		return $output;
	}


	/**
	 * Gets all the subscribers sorted by score or level
	 * @param  [type] $application [description]
	 * @param  [type] $limit       [description]
	 * @param  [type] $page        [description]
	 * @return [type]              [description]
	 */
	public function getLeaderboard($application, $order, $sort, $limit, $page)
	{
		$output = ['data' => [], 'pages' => []];
		
		if(!$limit) $limit = 25;
		if(!$page) $page = 1;
		if(!$sort) $sort = 'DESC';

		$subscribers = $application->subscribers()->with('profile')->orderBy($order, $sort)->paginate($limit);
		foreach($subscribers as $subscriber)
		{
			$arr['id']			= $subscriber->id;
			$arr['username'] 	= $subscriber->username;
			$arr['facebook_id'] = $subscriber->facebook_id;
			$arr['score']       = $subscriber->score;
			$arr['level']       = $subscriber->level;

			$arr['profile'] = [];
			if($subscriber->profile)
			{
				$arr['profile']['first_name'] = $subscriber->profile->first_name;
				$arr['profile']['last_name'] = $subscriber->profile->last_name;
				$arr['profile']['image'] = $subscriber->profile->image;
			}

			array_push($output['data'], $arr);
		}
		$output['pages'] = $this->getApiPagerLinks($subscribers, 'api.subscribers', [$application->api_key]);
		return $output;
	}



	/**
	 * Get all the subscribers sorted by a meta_key
	 * @param  [type] $application [description]
	 * @param  [type] $meta_key    [description]
	 * @param  [type] $sort        [description]
	 * @param  [type] $cast        [description]
	 * @param  [type] $limit       [description]
	 * @param  [type] $page        [description]
	 * @return [type]              [description]
	 */
	public function getLeaderboardMeta($application, $meta_key, $sort, $cast, $limit, $page)
	{
		$output = ['data' => [], 'pages' => []];
		
		if(!$limit) $limit = 25;
		if(!$page) $page = 1;
		if(!$sort) $sort = 'DESC';
		if(!$cast) $cast = 'SIGNED INTEGER'; //can be CHAR

		$subscribers = DB::table('subscriber')
					 ->join('game_meta', 'subscriber.id', '=', 'game_meta.subscriber_id')
					 ->leftJoin('subscriber_profile', 'subscriber.id', '=', 'subscriber_profile.subscriber_id')
                     ->select(DB::raw("subscriber.id, subscriber.username, subscriber.facebook_id, subscriber_profile.first_name, subscriber_profile.last_name, subscriber_profile.image, CAST(meta_value AS ".$cast.") meta_value_cast"))
                     ->where('application_id', '=', $application->id)
                     ->where('meta_key', '=', $meta_key)
                     ->orderBy('meta_value_cast', $sort)
                     ->paginate($limit);

       foreach($subscribers as $subscriber)
		{
			$arr['id']			= $subscriber->id;
			$arr['username'] 	= $subscriber->username;
			$arr['meta_value']  = $subscriber->meta_value_cast;
			$arr['facebook_id'] = $subscriber->facebook_id;
			$arr['profile'] = [];
			$arr['profile']['first_name'] = $subscriber->first_name;
			$arr['profile']['last_name'] = $subscriber->last_name;
			$arr['profile']['image'] = $subscriber->image;

			array_push($output['data'], $arr);
		}
		$output['pages'] = $this->getApiPagerLinks($subscribers, 'api.subscribers', [$application->api_key]);
		return $output;
	}



	/**
	 * Get the subscriber by email and password
	 * @param  [type] $email          [description]
	 * @param  [type] $password       [description]
	 * @param  [type] $application_id [description]
	 * @return [type]                 [description]
	 */
	public function loginViaEmail($email, $password, $application_id)
	{
		$subscriber = Subscriber::whereEmail($email)
							->whereApplicationId($application_id)
							->first();
		if(!$subscriber)
			return null;

		if(!Hash::check($password,$subscriber->password))
			return null;

		return $subscriber;
	} 


	/**
	 * Get the subscriber by his facebook id
	 * @param  [type] $facebook_id    [description]
	 * @param  [type] $application_id [description]
	 * @return [type]                 [description]
	 */
	public function loginViaFacebook($facebook_id, $application_id)
	{
		$subscriber = Subscriber::whereFacebookId($facebook_id)
							->whereApplicationId($application_id)
							->first();

		return $subscriber;
	}


	public function getApplicationDeviceTokens($application)
	{
		$subscribers = $application->subscribers()->with('devices')->get();
		$tokens_collected = [];
		foreach($subscribers as $subscriber)
			foreach($subscriber->devices as $device)
				array_push($tokens_collected, strtolower($device->token));
		//get the unique ones only
		$tokens_collected = array_unique($tokens_collected);
		return $tokens_collected;
	}


}