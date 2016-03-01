<?php

class EvezownSectionTableSeeder extends Seeder {

	public function run()
	{
		EvezownSection::create([
			'name' => 'Woice'
		]);

		EvezownSection::create([
			'name' => 'Wopportunity'
		]);

		EvezownSection::create([
			'name' => 'Products'
		]);

        EvezownSection::create([
            'name' => 'Services'
        ]);

        EvezownSection::create([
            'name' => 'Listing'
        ]);

        EvezownSection::create([
            'name' => 'ProductPlusService'
        ]);
	}
}