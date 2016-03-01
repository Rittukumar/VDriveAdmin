<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		// Create Reco posts.
		foreach(range(1, 4) as $index)
		{
			Post::create([
				'title' => $faker->word,
				'owner_id' => $faker->numberBetween(1, 10),
				'description' => $faker->paragraph($nbSentences = 3),
				'testimonial' => $faker->text($maxNbChars = 200),
				'brand_id' => $faker->numberBetween(1, 18),
				'location' => $faker->city . ', ' . $faker->state,
				'price_range' => $faker->numberBetween(800, 1500),
				'visibility_id' => $faker->numberBetween(1, 4),
				'post_type_id' => 1
			]);
		}

		// Create generic posts.
		foreach(range(1, 3) as $index)
		{
			Post::create([
				'title' => $faker->word,
				'owner_id' => $faker->numberBetween(1, 10),
				'description' => $faker->paragraph($nbSentences = 3),
				'visibility_id' => $faker->numberBetween(1, 4),
				'post_type_id' => 2
			]);
		}

		// Create Reco posts.
		foreach(range(1, 3) as $index)
		{
			Post::create([
				'title' => $faker->word,
				'owner_id' => $faker->numberBetween(1, 10),
				'description' => $faker->paragraph($nbSentences = 3),
				'testimonial' => $faker->text($maxNbChars = 200),
				'brand_id' => $faker->numberBetween(1, 18),
				'location' => $faker->city . ', ' . $faker->state,
				'price_range' => $faker->numberBetween(1000, 1500),
				'visibility_id' => $faker->numberBetween(1, 4),
				'post_type_id' => 3
			]);
		}

		// Create Reco posts.
		foreach(range(1, 3) as $index)
		{
			Post::create([
				'title' => $faker->word,
				'owner_id' => $faker->numberBetween(1, 10),
				'description' => $faker->paragraph($nbSentences = 3),
				'brand_id' => $faker->numberBetween(1, 18),
				'location' => $faker->city . ', ' . $faker->state,
				'visibility_id' => $faker->numberBetween(1, 4),
				'post_type_id' => 4
			]);
		}
	}
}