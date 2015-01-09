<?php

class Subscriber extends \Eloquent {
	protected $table = 'subscriber';
	protected $fillable = ['username', 'email', 'password', 'facebook_id', 'is_verified', 'verification_token', 'access_token','application_id'];

	/*****************
	 * RELATIONSHIPS *
	 *****************/
	public function devices()
	{
		return $this->hasMany('Device');
	}

	public function profile()
	{
		return $this->hasOne('SubscriberProfile');
	}

	public function game_metas()
	{
		return $this->hasMany('GameMeta');
	}

	public function application()
	{
		return $this->belongsTo('Application');
	}

	public function questions_subscribers()
	{
		return $this->hasMany('QuestionSubscriber');
	}

	/*******************
	 * FORM VALIDATION *
	 *******************/
	public $errors;
	public static $rules = [
		'username'      => 'required|username_unique_per_app',
		'email'       	=> 'required|email|email_unique_per_app|facebook_id_or_password_required',
	];

	public function isValid($data)
	{
		$validation = Validator::make($data, static::$rules);
		if($validation->passes())
		{
			return true;
		}

		$this->errors = $validation->messages();
		return false;
	}

	/**
	 * Leaderboard Rank for score, level 
	 * @param  [type] $order [description]
	 * @param  [type] $sort  [description]
	 * @return [type]        [description]
	 */
	public function getRank($order, $sort)
	{
		$operator = '<';
		if($sort == 'DESC')
			$operator = '>';

		$value = $this->score;
		if($order == 'level')
			$value = $this->level;

		if($value == 0)
			return 0;

		return (Subscriber::whereApplicationId($this->application_id)->where($order, $operator, $value)->count()) + 1;
	}

	/**
	 * Leaderboard Rank for metas 
	 * @param  [type] $order [description]
	 * @param  [type] $sort  [description]
	 * @return [type]        [description]
	 */
	public function getRankByMeta($meta_key, $sort, $cast = 'SIGNED INTEGER')
	{
		$operator = '<';
		$meta_value = '';

		if($sort == 'DESC')
			$operator = '>';
		
		$subscriber_metas = $this->game_metas->toArray();
		foreach($subscriber_metas as $metas)
			if($metas['meta_key'] == $meta_key)
				$meta_value = $metas['meta_value'];

		if($meta_value == "0" || $meta_value == "")
			return 0;

		$subscriber = DB::select(
			DB::RAW("
				SELECT COUNT(*) as rank
				FROM (
					SELECT subscriber.id, subscriber.username, game_meta.meta_key, game_meta.meta_value, CAST(meta_value AS SIGNED INTEGER) meta_value_cast 
					FROM subscriber 
					LEFT JOIN game_meta on subscriber.id = game_meta.subscriber_id 
					WHERE application_id = ".$this->application_id." 
					AND meta_key = '".$meta_key."' 
					ORDER BY meta_value_cast DESC 
				) AS T
				WHERE T.meta_value_cast ".$operator." ".$meta_value
				)
		);

        return ($subscriber[0]->rank + 1);
	}

	/**
	 * Returns activation link upon signup
	 * @return [type] [description]
	 */
	public function getActivationLink()
	{
		return route('activate.email', ['code' => $this->verification_token]);  
	}

	public function sendActivationMail()
	{
		Mail::send('emails.activation', [ 'link' => $this->getActivationLink() ], function($message)
		{
		    $message->to($this->email, $this->email)
		    		->subject( $this->subscriber->application->name." | Activate account" );
		});
	}
}