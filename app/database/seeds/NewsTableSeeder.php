<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NewsTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();	
		$faker = Faker::create();

		$news_category_ids = NewsCategory::lists('id');

		foreach(range(1, 50) as $index)
		{
			News::create([
				"name" => $faker->sentence(),
				"description" => $faker->text(),
				"caption" => $faker->paragraph(),
				"image" => "",
				"application_id" => 1,
				"news_category_id" => $faker->randomElement($news_category_ids)
			]);
		}
	}

}