<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ReccoSubscriptionsTableSeeder extends Seeder {

	public function run()
	{
        ReccoSubscription::create([
            'name' => 'monthly'
        ]);

        ReccoSubscription::create([
            'name' => 'quarterly'
        ]);

        ReccoSubscription::create([
            'name' => 'yearly'
        ]);
	}

}