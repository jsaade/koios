<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ApplicationTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Application::create([
			'name' => "NBA Stream",
			'description' => "NBA news and some other stuff",
			'image' => null,
			'slug' => uniqid(),
			'api_key' => uniqid(),
			'api_secret' => hash('sha256', substr('NBA Stream',0,9), false),
			'client_id' => 1
		]);

		DB::table('application_component')->insert([
			'application_id' => 1,
			'component_id' => 1
		]);

		DB::table('application_component')->insert([
			'application_id' => 1,
			'component_id' => 2
		]);

		DB::table('application_component')->insert([
			'application_id' => 1,
			'component_id' => 3
		]);				
	}

}