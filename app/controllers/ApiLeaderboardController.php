<?php

use \Acme\Repositories\DbSubscriberRepository;
use \Acme\ApiParser\SubscriberApiParser;

class ApiLeaderboardController extends \ApiController {

	public function __construct(DbSubscriberRepository $subscriberRepos, SubscriberApiParser $subscriberApiParser)
	{
		$this->subscriberRepos 	   = $subscriberRepos;
		$this->subscriberApiParser = $subscriberApiParser;
	}


	public function index(Application $application, $order)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$sort = Input::get('sort');

		if(!in_array($order, ['score', 'level']))
			return $this->respondErrors(  "The order is invalid.", "Bad request.", self::HTTP_BAD_REQUEST);


		$subscribers = $this->subscriberRepos->getLeaderboard($application, $order, $sort, $limit, $page);
		return $this->respondOk($this->subscriberApiParser->parseCollection($subscribers));
	}



	public function meta(Application $application, $meta_key)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$sort = Input::get('sort');
		$cast = Input::get('cast');

		$subscribers = $this->subscriberRepos->getLeaderboardMeta($application, $meta_key, $sort, $cast, $limit, $page);
		return $this->respondOk($this->subscriberApiParser->parseCollection($subscribers));
	}
}