<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder {

	public function run()
	{
		Eloquent::unguard();
		
		User::create([
			"username" => "jimmy_ghazal",
			"email" => "j.ghazal@mercury.me",
			"first_name" => "Jimmy",
			"last_name" => "Ghazal",
			"password" => Hash::make("mercury2k14")
		]);

		User::create([
			"username" => "elie_andraos",
			"email" => "e.andraos@mercury.me",
			"first_name" => "Elie",
			"last_name" => "Andraos",
			"password" => Hash::make("mercury2k14")
		]);

		User::create([
			"username" => "joseph_saade",
			"email" => "j.saade@mercury.me",
			"first_name" => "Joseph",
			"last_name" => "Saade",
			"password" => Hash::make("mercury2k14")
		]);
		
	}

}