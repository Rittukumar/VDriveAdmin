<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ImageTableAvatarImageSeeder extends Seeder {

	public function run()
	{
		DB::statement("insert into images values
						(360,'avatar.png','avatar.png','avatar.png','avatar.png',
						'Avatar','default avatar','2015-10-13 10:57:01','2015-10-13 10:57:01');
					 ");
	}

}