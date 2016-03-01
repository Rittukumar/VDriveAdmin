<?php


class RoleTableSeeder extends Seeder {

	public function run()
	{
		$owner = new Role;
		$owner->name = 'Admin';
		$owner->save();

		$owner = new Role;
		$owner->name = 'Moderator';
		$owner->save();

		$owner = new Role;
		$owner->name = 'User';
		$owner->save();
	}

}