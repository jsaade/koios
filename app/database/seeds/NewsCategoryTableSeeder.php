<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NewsCategoryTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		Eloquent::unguard();
		$categories = ['Team', 'Player', 'Playoffs', 'Trades', 'Rumors', 'Fans'];
		
		foreach($categories as $category)
		{
			NewsCategory::create([
				"name" => $category,
				"application_id" => 1
			]);
		}
	}
}