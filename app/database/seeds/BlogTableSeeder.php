<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class BlogTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 5) as $index)
		{
			Blog::create([
				'author_id' => 1,
				'title' => $faker->text($maxNbChars = 30),
				'content' => $faker->paragraph($nbSentences = 3),
				'tags' => 'lifestyle'
			]);

			Blog::create([
				'author_id' => 3,
				'title' => $faker->text($maxNbChars = 30),
				'content' => $faker->paragraph($nbSentences = 3),
				'tags' => 'lifestyle'
			]);

			Blog::create([
				'author_id' => 2,
				'title' => $faker->text($maxNbChars = 30),
				'content' => $faker->paragraph($nbSentences = 3),
				'tags' => 'lifestyle'
			]);
		}
	}

}