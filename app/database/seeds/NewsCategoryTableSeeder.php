<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NewsCategoryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 3) as $index)
		{
			NewsCategory::create([
				"name" => $faker->word(),
				"application_id" => 1
			]);
		}

		foreach(range(1, 3) as $index)
		{
			NewsCategory::create([
				"name" => $faker->word(),
				"application_id" => 2
			]);
		}

		foreach(range(1, 3) as $index)
		{
			NewsCategory::create([
				"name" => $faker->word(),
				"application_id" => 3
			]);
		}
	}
}