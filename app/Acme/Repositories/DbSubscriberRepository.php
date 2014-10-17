<?php
namespace Acme\Repositories;
use Subscriber;
use SubscriberProfile;
use Device;
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

		$subscribers = $application->subscribers()->where('is_verified', 1)->paginate($limit);
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
		$subscriber = Subscriber::with('devices')->with('profile')->findOrFail($id);
		$output = [];

		$output['id']			= $subscriber->id;
		$output['email'] 		= $subscriber->email;
		$output['username'] 	= $subscriber->username;
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
		

		return $output;
	}



	/**
	 * Creates a subscriber
	 * @param  [type] $input [description]
	 * @return [type]        [description]
	 */
	public function create($input)
	{
		$input['password'] = Hash::make($input['password']);
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
}