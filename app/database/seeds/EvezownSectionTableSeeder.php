<?php

class EvezownSectionTableSeeder extends Seeder {

	public function run()
	{
		EvezownSection::create([
			'name' => 'Stream It'
		]);

		EvezownSection::create([
			'name' => 'Jobs'
		]);

		EvezownSection::create([
			'name' => 'Stores'
		]);

        EvezownSection::create([
            'name' => 'Business'
        ]);

        EvezownSection::create([
            'name' => 'Listing'
        ]);

        EvezownSection::create([
            'name' => 'Stores Plus Business'
        ]);
	}
}