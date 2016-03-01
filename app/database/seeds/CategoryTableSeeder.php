<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        $categories = ['Health, Wellness & Fitness (HWF)','Food & Nutrition','Beauty & Fashion','Education, Care & Parenting','Lifestyle'
        ];

        foreach ($categories as $categoryName) {
            Category::create([
                'category_name' => $categoryName,
                'section_id' => 1
            ]);
        }
    }

}