<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ImagesTableSeeder extends Seeder {

	/**
	 *
     */
	public function run()
	{
		$faker = Faker::create();

		// First image for post
		$image = EvezownImage::create([
			'large_image_url' => '2015-01-18-14:30:57-trending_img1.jpg',
			'name' => $faker->word,
			'description' => $faker->sentence($nbWords = 6)
		]);

		PostImage::create([
			'post_id' => 1,
			'image_id' => $image->id
		]);

		// Second image for post
		$image =EvezownImage::create([
			'large_image_url' => '2015-01-18-14:48:30-sale_img4.jpg',
			'name' => $faker->word,
			'description' => $faker->sentence($nbWords = 6)
		]);

		PostImage::create([
			'post_id' => 2,
			'image_id' => $image->id
		]);

		// Third image for post
		$image =EvezownImage::create([
			'large_image_url' => '2015-01-18-14:49:47-sale_img1.jpg',
			'name' => $faker->word,
			'description' => $faker->sentence($nbWords = 6)
		]);

		PostImage::create([
			'post_id' => 3,
			'image_id' => $image->id
		]);

		// Fourth image for post
		$image =EvezownImage::create([
			'large_image_url' => '2015-01-18-14:51:46-trending_img3.jpg',
			'name' => $faker->word,
			'description' => $faker->sentence($nbWords = 6)
		]);

		PostImage::create([
			'post_id' => 4,
			'image_id' => $image->id
		]);
	}

}