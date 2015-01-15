<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ComponentTableSeeder extends Seeder {

	public function run()
	{
		$components = ['Pages Management', 'News', 'Quiz','Game Achievments', 'Contact Forms', 'Assets Library'];
		$desc = [
			'Creates static pages with all type of content (texts,images,videos,links).',
			'A module that generates news.',
			'Questions with multiple answers.',
			'Achievements list for any subscriber playing a game.',
			'Contact form with email notifications, attachments and reports.',
			'Upload and manage assets (any file type)'	
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