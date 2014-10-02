<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('ClientTableSeeder');
		$this->call('ComponentTableSeeder');
		$this->call('UsersTableSeeder');
	}

}
