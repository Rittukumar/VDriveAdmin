<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class NotSpecifiedTableSeeder extends Seeder {

	 public function run()
    {
        Category::create([
               'category_name' => 'Not Specified',
               'section_id' => 1
           ]);
    }

}