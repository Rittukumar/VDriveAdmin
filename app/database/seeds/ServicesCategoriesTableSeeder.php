<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ServicesCategoriesTableSeeder extends Seeder {

    public function run()
    {
        $categories = ['Health, Wellness & Fitness','Food & Nutrition','Beauty & Fashion','Education, Care & Parenting','Lifestyle','Business'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'category_name' => $categoryName,
                'section_id' => 4
            ]); 
        }
    }

}