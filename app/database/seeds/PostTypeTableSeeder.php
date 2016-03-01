<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PostTypeTableSeeder extends Seeder {

	public function run()
	{
		PostType::create([
			'type' => 'Just Sharing',
            'Post_Type' => 0
		]);
		PostType::create([
            'type' => 'Spread The Word',
            'Post_Type' => 0
		]);
		PostType::create([
            'type' => 'My Finds',
            'Post_Type' => 0
		]);
		PostType::create([
            'type' => 'Be Careful',
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