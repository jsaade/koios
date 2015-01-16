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
			$this->subscriber->sendActivationMail();
			return $this->respondOk(
				[
					'subscriberId' 		=> $this->subscriber->id, 
					'access_token' 		=> $this->subscriber->access_token				
				],
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


	/* POST method to create a subscriber and his profile in one call */
	public function register(Application $application)
	{
		$input = Input::all();
		$input['application_id'] = $application->id;
		$profile_errors = []; 
		
		if(!isset($input['first_name']))
			$profile_errors['first_name'] = ['The first_name is required'];
		
		if(!isset($input['last_name']))
			$profile_errors['last_name'] = ['The last_name is required'];

		if($this->subscriber->isValid($input) && !count($profile_errors))
		{
			$this->subscriber = $this->subscriberRepos->create($input);
			$subscriber_id = $this->subscriber->id;
			$input['subscriber_id'] = $subscriber_id;
			$subscriberProfile = $this->subscriberRepos->createProfile($input);

			$this->subscriber->sendActivationMail();
			return $this->respondOk(
				[
					'subscriberId' 			=> $subscriber_id, 
				 	'subscriberProfileId' 	=> $subscriberProfile->id, 
				 	'access_token' 			=> $this->subscriber->access_token
				 ], 
				'Subscriber and his profile was created successfully.',
				self::HTTP_CREATED
			);
		}

		return $this->respondErrors( array_merge($this->subscriber->errors->toArray(), $profile_errors), "Retry with valid parameters", self::HTTP_VALID_PARAMS);
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


	/* POST method to login a subscriber via email/password */
	public function loginViaEmail(Application $application)
	{
		$input = Input::all();
		$input['application_id'] = $application->id;
		$errors = [];
		
		if(!isset($input['email']))
			$errors['email'] = 'The email field is required';

		if(!isset($input['password']))
			$errors['password'] = 'The password field is required';

		if(count($errors))
		{
			return $this->respondErrors( $errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
		}
		else
		{
			$subscriber = $this->subscriberRepos->loginViaEmail($input['email'], $input['password'], $application->id);
			
			if($subscriber && !$subscriber->is_verified)
				return $this->respondErrors([], $message = "Forbidden | The subscriber is not verified", self::HTTP_FORBIDDEN, $headers = []);
			elseif($subscriber && $subscriber->is_verified)
				return $this->respondOk( ['subscriberId' => $subscriber->id, 'access_token' => $subscriber->access_token ], 'Subscriber was logged in.');
			else
				return $this->respondErrors([], $message = "Forbidden | Invalid Login Credentials", self::HTTP_FORBIDDEN, $headers = []);
		}
	}


	public function loginViaFacebook(Application $application)
	{
		$input = Input::All();
		$input['application_id'] = $application->id;

		if(!isset($input['facebook_user_token']))
			return $this->respondErrors( ['facebook_user_token' => 'The facebook user token is required'] , "Retry with valid parameters", self::HTTP_VALID_PARAMS);
		//get the user id from the facebook user token
		$url = "https://graph.facebook.com/me?access_token=".$input['facebook_user_token'];
		$content = file_get_contents($url);
		$info = json_decode($content);
		
		if(!$info->id)
			return $this->respondErrors( [] , "Invalid facebook user token.", self::HTTP_TOKEN_INVALID);

		$subscriber = $this->subscriberRepos->loginViaFacebook($info->id, $application->id);

		if($subscriber)
			return $this->respondOk( ['subscriberId' => $subscriber->id, 'access_token' => $subscriber->access_token ], 'Subscriber was logged in.');
		else
			return $this->respondErrors([], $message = "Forbidden | Invalid Login Credentials", self::HTTP_FORBIDDEN, $headers = []);

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

		//remove the unique rule as we are updating
		$rules = GameMeta::$rules;
		$rules['meta_key'] = 'alpha_dash';

		if(!$game_meta->isValid($input, $rules))
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
		return $this->respondOk(['subscriberId' => $subscriber->id ],  'No content | Game meta deleted.', self::HTTP_NO_CONTENT );
	}


	/* POST method to delete subscriber device */
	public function destroyDevice(Application $application, Subscriber $subscriber)
	{
		$input = Input::all();
		$device = new Device();

		$rules =['token' => 'required'];
		
		if(!$device->isValid($input, $rules))
			return $this->respondErrors( $device->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);

		$device = Device::whereToken($input['token'])->whereSubscriberId($subscriber->id)->first();
		if(!$device)
			return $this->respondErrors( "The device token does not exist.", "Bad request.", self::HTTP_BAD_REQUEST);


		$device->delete();
		return $this->respondOk(['subscriberId' => $subscriber->id ],  'No content | Device deleted.', self::HTTP_NO_CONTENT );
	}


	/* GET method to display game info */
	public function gameInfo(Application $application, Subscriber $subscriber)
	{
		$subscriber = $this->subscriberRepos->getGameInfo($subscriber->id);
		return $this->respondOk($this->subscriberApiParser->parse($subscriber));
	}



	/* Post method to save a subscribers answer on a question */
	public function storeQuestionSubscriber(Application $application, Subscriber $subscriber, Question $question)
	{
		$input = Input::all();
		$input['subscriber_id']  = $subscriber->id;
		$input['question_id'] = $question->id;
		$question_subscriber = new QuestionSubscriber();

		if($question_subscriber->isValid($input))
		{
			$question_subscriber = QuestionSubscriber::create($input);
			return $this->respondOk(
				['QuestionSubscriberId' => $question_subscriber->id ], 
				'Question was answered successfully.',
				self::HTTP_CREATED
			);
		}

		return $this->respondErrors( $question_subscriber->errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);
	}



	/* GET method to display quiz answers */
	public function answers(Application $application, Subscriber $subscriber)
	{
		$subscriber_questions = $subscriber->questions_subscribers()->with('question')->get();
		$output = [];
		foreach($subscriber_questions as $subscriber_question)
		{
			$arr = [];
			$arr['question_id'] = $subscriber_question->question_id;
			$arr['question_description'] = $subscriber_question->question->description;
			$arr['answer_id'] = $subscriber_question->answer_id;

			$answer = Answer::where('is_correct', '=', 1)->whereQuestionId($subscriber_question->question_id)->first();
			$arr['answer_correct'] = $answer->id;
			array_push($output, $arr);
		}
		return $this->respondOk($output);
	}



	public function resendActivationEmail(Application $application)
	{
		$input = Input::all();
		$errors = [];
		
		if(!isset($input['email']))
			$errors['email'] = 'The email field is required';
		if(count($errors))
			return $this->respondErrors( $errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);

		$subscriber = $this->subscriberRepos->findByEmail($input['email'], $application->id);
		if(!$subscriber)
			$errors['email'] = 'Subscriber with this email does not exist.';

		if(count($errors))
			return $this->respondErrors( $errors, "No content", self::HTTP_NO_CONTENT);

		$subscriber->sendActivationMail();
		return $this->respondOk([], 'Activation email sent successfully.', self::HTTP_NO_CONTENT);
	}



	public function sendForgotPasswordEmail(Application $application)
	{
		$input = Input::all();
		$errors = [];
		
		if(!isset($input['email']))
			$errors['email'] = 'The email field is required';
		if(count($errors))
			return $this->respondErrors( $errors, "Retry with valid parameters", self::HTTP_VALID_PARAMS);

		$subscriber = $this->subscriberRepos->findByEmail($input['email'], $application->id);
		if(!$subscriber)
			$errors['email'] = 'Subscriber with this email does not exist.';

		if(count($errors))
			return $this->respondErrors( $errors, "No content", self::HTTP_NO_CONTENT);

		$subscriber->sendForgotPasswordMail();
		return $this->respondOk([], 'Forgot password email sent successfully.', self::HTTP_NO_CONTENT);
	}
}