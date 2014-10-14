<?php
use \Acme\Repositories\DbSubscriberRepository;

class ApiSubscriberController extends \ApiController {

	protected $subscriber;

	public function __construct(Subscriber $subscriber, DbSubscriberRepository $subscriberRepos)
	{
		$this->subscriber = $subscriber;
		$this->subscriberRepos = $subscriberRepos;
	}


	//POST method to create subscriber
	public function store(Application $application)
	{
		$input = Input::all();
		$input['application_id'] = $application->id;

		if($this->subscriber->isValid($input))
		{
			$this->subscriber = $this->subscriberRepos->create($input);
			//send response
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
		$input['application_id'] = $application->id;

		if($this->subscriber->isValid($input))
		{
			$this->subscriber = $this->subscriberRepos->createProfile($input);
		}

		return $this->respondErrors( $this->subscriber->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);

	}

}