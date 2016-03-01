<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class EvezplaceListingTableSeeder extends Seeder {

    public function run()
    {
        $categories = [
            'F & B','Travel Packages','Interests & Hobbies','Care','Home','Events & Exhibitions','Entertainment','Pre-Owned','Real Estate','Automobiles','Matrimonial','New Brands'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'category_name' => $categoryName,
                'section_id' => 5
            ]);
        }
    }

}