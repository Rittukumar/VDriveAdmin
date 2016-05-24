<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class AdminConfigurationTableSeeder extends Seeder {

	public function run()
	{
        AdminConfigurations::create([
            'config_name' => 'Evezown Admin',
            'config_value' => 'editor@evezown.com'
		]);

        /*Add new values if any*/
        /*AdminConfigurations::create([
            'config_name' => 'New Value',
            'config_value' => 'New data'
        ]);*/
	}

}