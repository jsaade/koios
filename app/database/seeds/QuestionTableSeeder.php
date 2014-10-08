<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class QuestionTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();	
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Question::create([
				'description' => $faker->sentence(12),
				'application_id' => 1
			]);

			Question::create([
				'description' => $faker->sentence(12),
				'application_id' => 2
			]);

			Question::create([
				'description' => $faker->sentence(12),
				'application_id' => 3
			]);
		}
	}

}