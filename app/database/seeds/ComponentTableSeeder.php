<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ComponentTableSeeder extends Seeder {

	public function run()
	{
		$components = ['Pages Management', 'News', 'Q&A'];
		$desc = [
			'Creates static pages with all type of content (texts,images, videos, links ...',
			'A module that generates news',
			'Questions with multiple answers (includes quiz ability'	
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