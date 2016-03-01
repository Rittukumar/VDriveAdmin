<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class VisibilityTableSeeder extends Seeder {

	public function run()
	{
		Visibility::create([
			'type' => 'all',
		]);

		Visibility::create([
			'type' => 'circles',
		]);

		Visibility::create([
			'type' => 'friends',
		]);

		Visibility::create([
			'type' => 'me',
		]);
	}

}