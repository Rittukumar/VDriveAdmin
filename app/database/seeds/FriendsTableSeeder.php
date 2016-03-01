<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FriendsTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$userIds = UserProfile::lists('id');

		foreach(range(1, 30) as $index)
		{
			DB::table('friends')->insert(array(
				'user_id' => 1,
				'friend_user_id' => $faker->randomElement($userIds),
				'status' => 'active'
			));
			DB::table('friends')->insert(array(
				'user_id' => 2,
				'friend_user_id' => $faker->randomElement($userIds),
				'status' => 'active'
			));
			DB::table('friends')->insert(array(
				'user_id' => 3,
				'friend_user_id' => $faker->randomElement($userIds),
				'status' => 'active'
			));
			DB::table('friends')->insert(array(
				'user_id' => 4,
				'friend_user_id' => $faker->randomElement($userIds),
				'status' => 'active'
			));
		}
	}

}