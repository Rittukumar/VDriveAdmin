<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ListingsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 3) as $index)
		{
			Product::create([
				'title' => $faker->word,
				'description' => $faker->sentence($nbSentences = 3),
				'store_id' => 1,
				'sub_cat_id' => 1,
				'price' => $faker->randomNumber(3)
			]);
		}

		foreach(range(1, 3) as $index)
		{
			Product::create([
				'title' => $faker->word,
				'description' => $faker->sentence($nbSentences = 3),
				'store_id' => 2,
				'sub_cat_id' => 2,
				'price' => $faker->randomNumber(3)
			]);
		}

		foreach(range(1, 3) as $index)
		{
			Product::create([
				'title' => $faker->word,
				'description' => $faker->sentence($nbSentences = 3),
				'store_id' => 3,
				'sub_cat_id' => 3,
				'price' => $faker->randomNumber(3)
			]);
		}
	}

}