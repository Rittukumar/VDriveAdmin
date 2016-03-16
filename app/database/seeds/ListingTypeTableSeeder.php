<?php


class ListingTypeTableSeeder extends Seeder {

	public function run()
	{
        ListingType::create([
            'name' => 'Stores'
        ]);

        ListingType::create([
            'name' => 'Business'
        ]);

        ListingType::create([
            'name' => 'Stores + Business'
        ]);

	}

}