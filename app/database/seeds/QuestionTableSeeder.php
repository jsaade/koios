<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuestionTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();	
		$faker = Faker::create();

		foreach(range(1, 15) as $index)
		{
			Question::create([
				'description' => $faker->sentence(),
				'application_id' => 1
			]);
		}
	}
}