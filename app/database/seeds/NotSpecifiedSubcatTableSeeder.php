<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NotSpecifiedSubcatTableSeeder extends Seeder {

	public function run()
	{
		SubCategory::create([
			'subcategory_name' => 'Not Specified',
			'category_id' => 34
		]);

	}

}