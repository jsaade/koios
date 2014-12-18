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
		$limit  		= Input::get('limit');
		$page   		= Input::get('page');
		$sort   		= (Input::get('sort'))?:'DESC';
		$subscriber_id  = Input::get('subscriber_id');
		$rank = 0;

		if(!in_array($order, ['score', 'level']))
			return $this->respondErrors(  "The order is invalid.", "Bad request.", self::HTTP_BAD_REQUEST);

		if($subscriber_id)
		{
			$subscriber = $this->subscriberRepos->find($subscriber_id, "object");
			$rank = $subscriber->getRank($order, $sort);
		}

		$subscribers = $this->subscriberRepos->getLeaderboard($application, $order, $sort, $limit, $page);
		$data = array_merge( $this->subscriberApiParser->parseCollection($subscribers), ['rank' => $rank ] );
		return $this->respondOk($data);
	}



	public function meta(Application $application, $meta_key)
	{
		$limit = Input::get('limit');
		$page = Input::get('page');
		$sort = (Input::get('sort'))?:'DESC';
		$cast = (Input::get('cast'))?:'SIGNED INTEGER';
		$subscriber_id = Input::get('subscriber_id');
		$rank = 0;
		
		if($subscriber_id)
		{
			$subscriber = $this->subscriberRepos->find($subscriber_id, "object");
			$rank = $subscriber->getRankByMeta($meta_key, $sort, $cast);
		}

		$subscribers = $this->subscriberRepos->getLeaderboardMeta($application, $meta_key, $sort, $cast, $limit, $page);
		$data = array_merge( $this->subscriberApiParser->parseCollection($subscribers), ['rank' => $rank ] );
		return $this->respondOk($data);	}
}