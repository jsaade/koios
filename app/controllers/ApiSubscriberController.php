<?php
use \Acme\Repositories\DbSubscriberRepository;
use \Acme\ApiParser\SubscriberApiParser;

class ApiSubscriberController extends \ApiController {

	protected $subscriber;

	public function __construct(Subscriber $subscriber, DbSubscriberRepository $subscriberRepos, SubscriberApiParser $subscriberApiParser)
	{
		$this->subscriber 		   = $subscriber;
		$this->subscriberRepos 	   = $subscriberRepos;
		$this->subscriberApiParser = $subscriberApiParser;
	}


	//Get all the application verfied subscribers
	public function index(Application $application)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$subscribers = $this->subscriberRepos->getAll($application, $limit, $page);

		return $this->respondOk($this->subscriberApiParser->parseCollection($subscribers));
	}	
	


	// Get a single subscriber	
	public function show(Application $application, Subscriber $subscriber)
	{
		$subscriber = $this->subscriberRepos->find($subscriber->id);
		return $this->respondOk($this->subscriberApiParser->parse($subscriber));
	}


	//POST method to create subscriber
	public function store(Application $application)
	{
		$input = Input::all();
		dd($input);
		$input['application_id'] = $application->id;

		if($this->subscriber->isValid($input))
		{
			$this->subscriber = $this->subscriberRepos->create($input);
			return $this->respondOk(
				['subscriberId' => $this->subscriber->id], 
				'Subscriber was created successfully.'
			);
		}

		return $this->respondErrors( $this->subscriber->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}



	//POST method to create a user profile
	public function storeProfile(Application $application, Subscriber $subscriber)
	{
		$input = Input::all();
		$input['subscriber_id'] = $subscriber->id;
		$subscriberProfile = new subscriberProfile();

		if($subscriberProfile->isValid($input))
		{
			$subscriberProfile = $this->subscriberRepos->createProfile($input);
			return $this->respondOk(
				['subscriberProfileId' => $subscriberProfile->id, 'subscriberId' => $subscriber->id ], 
				'Subscriber profile was created successfully.'
			);
		}

		return $this->respondErrors( $subscriberProfile->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}



	//POST method to create a user profile
	public function storeDevice(Application $application, Subscriber $subscriber)
	{
		$input = Input::all();
		$input['subscriber_id'] = $subscriber->id;
		$device = new Device();

		if($device->isValid($input))
		{
			$device = $this->subscriberRepos->createDevice($input);
			return $this->respondOk(
				['deviceId' => $device->id, 'subscriberId' => $subscriber->id ], 
				'Subscriber device was created successfully.'
			);
		}

		return $this->respondErrors( $device->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}
}