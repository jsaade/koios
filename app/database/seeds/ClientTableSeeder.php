<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ClientTableSeeder extends Seeder {

	public function run()
	{
		$clients = ['Mercury', 'Lebanese Army'];

		foreach($clients as $client)
		{
			Client::create([
				'name' => $client
			]);
		}
	}

}