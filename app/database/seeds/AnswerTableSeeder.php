<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AnswerTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		$questions_ids = Question::lists('id');

		foreach($questions_ids as $id)
		{
			$is_correct = $faker->randomElement([1,2,3,4]); 

			foreach(range(1, 4) as $index)
			{
				Answer::create([
					'description' => $faker->sentence(3),
					'is_correct' => ($index == $is_correct)?true:false,
					'question_id' => $id
				]);
			}
		}
	}

}