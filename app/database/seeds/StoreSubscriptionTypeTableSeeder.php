<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StoreSubscriptionTypeTableSeeder extends Seeder {

	public function run()
	{
        StoreSubscriptionType::create([
            'name' => 'Free Basic',
            'value' => 'F'
		]);

        StoreSubscriptionType::create([
            'name' => 'Paid Standard',
            'value' => 'PS'
        ]);

        StoreSubscriptionType::create([
            'name' => 'Paid Customized',
            'value' => 'PC'
        ]);
	}

}