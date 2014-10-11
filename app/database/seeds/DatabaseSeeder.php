<?php

class DatabaseSeeder extends Seeder {

	
	private $tables = [
		'users', 
		'client', 
		'component',
		'application',
		'application_component',
		'news_category',
		'news',
		'question',
		'answer' 
	];

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		$this->cleanUp();

		//call the seeders
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');
		$this->call('UsersTableSeeder');
		$this->call('ClientTableSeeder');
		$this->call('ComponentTableSeeder');
		$this->call('ApplicationTableSeeder');
		$this->call('NewsCategoryTableSeeder');
		$this->call('NewsTableSeeder');
		$this->call('QuestionTableSeeder');
		$this->call('AnswerTableSeeder');
		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

	
	private function cleanUp()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS = 0');

		foreach($this->tables as $tablename)
			DB::table($tablename)->truncate();

		DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
