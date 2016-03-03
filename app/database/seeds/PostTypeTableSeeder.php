<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostTypeTableSeeder extends Seeder {

	public function run()
	{
		PostType::create([
			'type' => 'I Recommend',
            'Post_Type' => 0
		]);
		PostType::create([
            'type' => 'Share / Ask',
            'Post_Type' => 0
		]);
		PostType::create([
            'type' => 'My Find',
            'Post_Type' => 0
		]);
		PostType::create([
            'type' => 'Be Cautious',
            'Post_Type' => 0
		]);
        PostType::create([
            'type' => 'Product',
            'Post_Type' => 1
        ]);
        PostType::create([
            'type' => 'Service',
            'Post_Type' => 1
        ]);
        PostType::create([
            'type' => 'Person',
            'Post_Type' => 1
        ]);
        PostType::create([
            'type' => 'Place',
            'Post_Type' => 1
        ]);
	}

}