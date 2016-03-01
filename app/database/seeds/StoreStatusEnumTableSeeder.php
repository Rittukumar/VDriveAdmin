<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class StoreStatusEnumTableSeeder extends Seeder {

	public function run()
	{
		StoreStatusEnum::create([
			'status' => 'Inactive'
		]);

		StoreStatusEnum::create([
			'status' => 'Active'
		]);

		StoreStatusEnum::create([
			'status' => 'Published'
		]);

		StoreStatusEnum::create([
			'status' => 'Suspended'
		]);

		StoreStatusEnum::create([
			'status' => 'Blocked'
		]);
	}

}