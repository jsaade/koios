<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ApplicationTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Application::create([
			'name' => $faker->name(),
			'description' => $faker->sentence(5),
			'image' => null,
			'slug' => uniqid(),
			'api_key' => uniqid().uniqid(),
			'api_secret' => Hash::make($faker->word()),
			'client_id' => 1
		]);

		Application::create([
			'name' => $faker->name(),
			'description' => $faker->sentence(5),
			'image' => null,
			'slug' => uniqid(),
			'api_key' => uniqid().uniqid(),
			'api_secret' => Hash::make($faker->word()),
			'client_id' => 1
		]);
	}

}