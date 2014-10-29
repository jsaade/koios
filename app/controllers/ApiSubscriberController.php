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


	/* GET all the application subscribers */
	public function index(Application $application)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$subscribers = $this->subscriberRepos->getAll($application, $limit, $page);

		return $this->respondOk($this->subscriberApiParser->parseCollection($subscribers));
	}	


	/* GET a single subscriber info */
	public function show(Application $application, Subscriber $subscriber)
	{
		$subscriber = $this->subscriberRepos->find($subscriber->id);
		return $this->respondOk($this->subscriberApiParser->parse($subscriber));
	}


	/* POST method to create subscriber */
	public function store(Application $application)
	{
		$input = Input::all();
		$input['application_id'] = $application->id;

		if($this->subscriber->isValid($input))
		{
			$this->subscriber = $this->subscriberRepos->create($input);
			return $this->respondOk(
				['subscriberId' => $this->subscriber->id, 'access_token' => $this->subscriber->access_token],
				'Subscriber was created successfully.',
				self::HTTP_CREATED
			);
		}

		return $this->respondErrors( $this->subscriber->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}


	/* POST method to create a subscriber profile */
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
				'Subscriber profile was created successfully.',
				self::HTTP_CREATED
			);
		}

		return $this->respondErrors( $subscriberProfile->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}


	/* POST method to create a subscriber device */
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
				'Subscriber device was created successfully.',
				self::HTTP_CREATED
			);
		}

		return $this->respondErrors( $device->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}

	/* POST method to update the subscriber score and level */
	public function update(Application $application, Subscriber $subscriber)
	{
		$input = Input::all();
		$errors = [];
		
		if(!isset($input['score']))
			$errors['score'] = 'The score field is required';

		if(!isset($input['level']))
			$errors['level'] = 'The level field is required';

		if(!count($errors))
		{
			$this->subscriberRepos->update($input, $subscriber);
			return $this->respondOk( ['subscriberId' => $subscriber->id ], 'Subscriber was updated successfully.');
		}

		return $this->respondErrors( $errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}


	/* POST method to create subscriber game meta */
	public function storeGameMeta(Application $application, Subscriber $subscriber)
	{
		$input = Input::all();
		$input['subscriber_id'] = $subscriber->id;
		$game_meta = new GameMeta();

		if($game_meta->isValid($input))
		{
			$game_meta = GameMeta::create($input);
			return $this->respondOk(
				['GameMetaId' => $game_meta->id, 'subscriberId' => $subscriber->id ], 
				'Game meta was created successfully.',
				self::HTTP_CREATED
			);
		}

		return $this->respondErrors( $game_meta->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}


	/* POST method to update subscriber game meta */
	public function updateGameMeta(Application $application, Subscriber $subscriber, $meta_key)
	{
		$game_meta = GameMeta::whereMetaKey($meta_key)->whereSubscriberId($subscriber->id)->first();
		if(!$game_meta)
			return $this->respondErrors( "The meta key does not exist.", "Bad request.", self::HTTP_BAD_REQUEST);
		
		$input = Input::all();
		$input['subscriber_id'] = $subscriber->id;
		$input['meta_key'] = $meta_key;

		if(!$game_meta->isValid($input))
			return $this->respondErrors( $game_meta->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);

		$game_meta->update($input);
		return $this->respondOk(
				['GameMetaId' => $game_meta->id, 'subscriberId' => $subscriber->id ], 
				'Game meta was updated successfully.',
				self::HTTP_RESPONSE_OK
			);
	}


	/* POST method to delete subscriber game meta */
	public function destroyGameMeta(Application $application, Subscriber $subscriber, $meta_key)
	{
		$game_meta = GameMeta::whereMetaKey($meta_key)->whereSubscriberId($subscriber->id)->first();
		if(!$game_meta)
			return $this->respondErrors( "The meta key does not exist.", "Bad request.", self::HTTP_BAD_REQUEST);

		$game_meta->delete();
		return $this->respondOk(
				['subscriberId' => $subscriber->id ], 
				'No content | Game meta deleted.',
				self::HTTP_NO_CONTENT
			);
	}


	/* GET method to display game info */
	public function gameInfo(Application $application, Subscriber $subscriber)
	{
		$subscriber = $this->subscriberRepos->getGameInfo($subscriber->id);
		return $this->respondOk($this->subscriberApiParser->parse($subscriber));
	}
}