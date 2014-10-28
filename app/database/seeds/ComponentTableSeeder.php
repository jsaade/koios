<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ComponentTableSeeder extends Seeder {

	public function run()
	{
		$components = ['Pages Management', 'News', 'Quiz','Game Achievments'];
		$desc = [
			'Creates static pages with all type of content (texts,images,videos,links)',
			'A module that generates news',
			'Questions with multiple answers',
			'Achievements list for any subscriber playing a game'	
			];

		foreach($components as $key => $val)
		{
			Component::create([
				'name' => $val,
				'description' => $desc[$key]
			]);
		}
	}

}