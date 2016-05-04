<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StoreStatusEnumTableSeederAdditions extends Seeder {

	public function run()
	{
		StoreStatusEnum::create([
			'status' => 'Payment pending'
		]);

		StoreStatusEnum::create([
			'status' => 'Paid'
		]);

		StoreStatusEnum::create([
			'status' => 'Requested'
		]);
	}

}