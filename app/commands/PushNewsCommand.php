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

		//validate the application
		if(!$application)
		{
			$this->error("The application provided does not exist.");
			return;
		}
		
		//get the news to be pushed
		$news = $this->newsRepos->getPushNews($application);
		if(!$news->count())
		{
			$this->info($application->name." | There is no pending news to be pushed.");
			return;
		}
		
		//get the devices 
		$ios_app = PushNotification::app($application->slug.'_IOS');
		$ios_device_tokens = $application->getApplicationDeviceTokens("iphone");
		$ios_devices = $application->prepareIosPushDevices($ios_app, $ios_device_tokens);

		//push the news
		foreach($news as $n)
		{
			$title = $n->name;
			$args = [$n->id, $n->news_category_id];
			$message = PushNotification::Message( $title , ['badge' => 1, 'locArgs' =>$args]);	
			
			$ios_app->to($ios_devices)->send($message);
			$n->update(['push_status' => 'sent']);
		}
		$this->info( $application->name." | ".$news->count()." news were pushed to ".count($ios_tokens)." ios devices.");
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
