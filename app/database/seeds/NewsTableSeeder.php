<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NewsTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();	
		$faker = Faker::create();

		$news_category_ids = [1,2,3];
		foreach(range(1, 3) as $index)
		{
			News::create([
				"name" => $faker->sentence(8),
				"description" => $faker->paragraph(5),
				"caption" => $faker->paragraph(1),
				"image" => "",
				"application_id" => 1,
				"news_category_id" => $news_category_ids[$index-1]
			]);
		}

		$news_category_ids = [4,5,6];
		foreach(range(1, 3) as $index)
		{
			News::create([
				"name" => $faker->sentence(8),
				"description" => $faker->paragraph(5),
				"caption" => $faker->paragraph(1),
				"image" => "",
				"application_id" => 2,
				"news_category_id" => $news_category_ids[$index-1]
			]);
		}

		$news_category_ids = [7,8,9];
		foreach(range(1, 3) as $index)
		{
			News::create([
				"name" => $faker->sentence(8),
				"description" => $faker->paragraph(5),
				"caption" => $faker->sentence(8),
				"image" => "",
				"application_id" => 3,
				"news_category_id" => $news_category_ids[$index-1]
			]);
		}		
	}

}