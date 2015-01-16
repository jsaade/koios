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
		var_dump($slug);
		$application = Application::whereSlug($slug)->first();

		//validate the application
		if(!$application)
		{
			$this->error("The application provided does not exist.");
			return;
		}
		//get the news
		$news = $this->newsRepos->getPushNews($application);
		if(!$news->count())
		{
			$this->info($application->name." | There is no pending news to be pushed.");
			return;
		}
		//get the devices
		$device_tokens = $this->subscriberRepos->getApplicationDeviceTokens($application);
		if(!count($device_tokens))
		{
			$this->info($application->name." | No tokens (devices) found.");
			return;
		}		
		//all is well, prepare tokens to be pushed
		$tokens = [];
		foreach($device_tokens as $t)
			array_push( $tokens, PushNotification::Device($t));
		$devices = PushNotification::DeviceCollection($tokens);
		//Push the news and update database
		foreach($news as $n)
		{
			$message = PushNotification::Message( $n->name, array(
			    'badge' => 1,
			    'locArgs' => array( $n->id, $n->news_category_id)
			));	
			$app = PushNotification::app($application->slug.'_IOS');
			try{
				
				$push = $app->to($devices)->send($message);	
			}	
			catch(Exception $e) {
				dd($app->pushManager); 
			}
				
			
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
