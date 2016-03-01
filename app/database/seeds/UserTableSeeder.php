<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		$this->createUser([
			'email' => 'meena@creativethoughtstech.in',
			'password' => 'test',
			'firstname' => 'Meena',
			'lastname' => 'Mahesh',
			'role' => 2
		]);

		$this->createUser([
			'email' => 'varsha.anand13@gmail.com',
			'password' => 'test',
			'firstname' => 'Varsha',
			'lastname' => 'Anand',
			'role' => 1
		]);

		$this->createUser([
			'email' => 'radhakrishnan.radha@gmail.com',
			'password' => 'test',
			'firstname' => 'Radha',
			'lastname' => 'Radhakrishnan',
			'role' => 1
		]);
	}

	/**
	 * @param $userDetails
     */
	protected function createUser($userDetails)
	{
		$user = new User();
		$user->email = $userDetails['email'];
		$user->password = $userDetails['password'];
		$user->password_confirmation = $userDetails['password'];
		$user->username = $userDetails['email'];
		$user->confirmation_code = md5(uniqid(mt_rand(), true));
		$user->save();

		$profileId = DB::table('user_profile')->insert(array(
			'firstname' => $userDetails['firstname'],
			'lastname' => $userDetails['lastname'],
			'user_id' => $user->id,
			'dob_id' =>1
		));

		$role = Role::find($userDetails['role']);

		$user = User::find($user->id);
		$user->attachRole( $role );

		if (!$user->id) {
			Log::info('Unable to create user ' . $user->id, (array)$user->id->errors());
		} else {
			Log::info('Created user "' . $user->id . '" <' . $user->id . '>');
		}
	}

}