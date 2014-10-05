<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ApplicationTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Application::create([
			'name' => "Bachir",
			'description' => "Bachir Gemayel life biography",
			'image' => null,
			'slug' => uniqid(),
			'api_key' => uniqid().uniqid(),
			'api_secret' => Hash::make($faker->word()),
			'client_id' => 1
		]);

		Application::create([
			'name' => "KiteRun",
			'description' => "Can your kite survive a war?",
			'image' => null,
			'slug' => uniqid(),
			'api_key' => uniqid().uniqid(),
			'api_secret' => Hash::make($faker->word()),
			'client_id' => 1
		]);

		Application::create([
			'name' => "Lebanese Army",
			'description' => "All in one app for LAF.",
			'image' => null,
			'slug' => uniqid(),
			'api_key' => uniqid().uniqid(),
			'api_secret' => Hash::make($faker->word()),
			'client_id' => 2
		]);
	}

}