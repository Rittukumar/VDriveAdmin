<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StoresTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		Store::create([
			'title' => $faker->company,
			'owner_id' => 1,
			'description' => $faker->paragraph($nbSentences = 3),
			'web_address' => $faker->url,
			'email_address' => $faker->companyEmail,
			'street_address' => $faker->address,
			'city' => $faker->city,
			'state' => $faker->state,
			'country' => $faker->country,
			'zip' => $faker->postcode,
		]);

		Store::create([
			'title' => $faker->company,
			'owner_id' => 2,
			'description' => $faker->paragraph($nbSentences = 3),
			'web_address' => $faker->url,
			'email_address' => $faker->companyEmail,
			'street_address' => $faker->address,
			'city' => $faker->city,
			'state' => $faker->state,
			'country' => $faker->country,
			'zip' => $faker->postcode,
		]);

		Store::create([
			'title' => $faker->company,
			'owner_id' => 3,
			'description' => $faker->paragraph($nbSentences = 3),
			'web_address' => $faker->url,
			'email_address' => $faker->companyEmail,
			'street_address' => $faker->address,
			'city' => $faker->city,
			'state' => $faker->state,
			'country' => $faker->country,
			'zip' => $faker->postcode,
		]);
	}

}