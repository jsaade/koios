<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use \Acme\Repositories\DbNewsRepository;
use \Acme\Repositories\DbSubscriberRepository;

class PushNewsCommand extends Command {

	protected $newsRepos;
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'koios:push-news';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Sends news push notifications to devices.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(DbNewsRepository $newsRepos, DbSubscriberRepository $subscriberRepos)
	{
		$this->newsRepos = $newsRepos;
		$this->subscriberRepos = $subscriberRepos;
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$slug = $value = $this->argument('application');
		$application = Application::whereSlug($slug)->first();

		/* VALIDATE THE APPLICATION */
		if(!$application)
		{
			$this->error("The application provided does not exist.");
			return;
		}
		
		/* GET HTE NEWS TO BE PUSHED */
		$news = $this->newsRepos->getPushNews($application);
		if(!$news->count())
		{
			$this->info($application->name." | There is no pending news to be pushed.");
			return;
		}
		
		/* GET THE DEVICES */ 
		$device_tokens = $this->subscriberRepos->getApplicationDeviceTokens($application, "iphone");
		if(!count($device_tokens))
		{
			$this->info($application->name." | No tokens (devices) found.");
			return;
		}
		
		/* ALL IS WELL, PREPARE DEVICE TOKENS TO BE PUSHED */
		$app_ios = PushNotification::app($application->slug.'_IOS');
		$tokens = [];
		foreach($device_tokens as $t)
		{
			//check if the token is in good format and supported
			if( $app_ios->adapter->supports($t) )
				array_push( $tokens, PushNotification::Device($t));
			//else : remove the device
		}
		$devices = PushNotification::DeviceCollection($tokens);

		/* PUSH THE NEWS TO THE DEVICES AND UPDATE DATABASE */
		foreach($news as $n)
		{
			$message = PushNotification::Message( $n->name, array(
			    'badge' => 1,
			    'locArgs' => array( $n->id, $n->news_category_id)
			));	
			$app_ios->to($devices)->send($message);
			
			//var_dump($app_ios->pushManager->getFeedback()); 
			
			die('sent');
			$n->update(['push_status' => 'sent']);
		}
		$this->info( $application->name." | ".$news->count()." news were pushed to ".count($tokens)." devices.");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('application', InputArgument::REQUIRED, 'Application unique slug.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
