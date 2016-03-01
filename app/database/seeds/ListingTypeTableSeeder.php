<?php


class ListingTypeTableSeeder extends Seeder {

	public function run()
	{
        ListingType::create([
            'name' => 'Products'
        ]);

        ListingType::create([
            'name' => 'Services'
        ]);

        ListingType::create([
            'name' => 'Products + Services'
        ]);

	}

}