<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class PermissionsTableSeeder extends Seeder {

	public function run()
	{
		$admin = Role::find(1);
		$moderator = Role::find(2);

		$managePosts = new Permission;
		$managePosts->name = 'manage_admin_posts';
		$managePosts->display_name = 'Manage Admin Posts';
		$managePosts->save();

		$manageUsers = new Permission;
		$manageUsers->name = 'manage_admin_users';
		$manageUsers->display_name = 'Manage Users';
		$manageUsers->save();

		$manageBlogs = new Permission;
		$manageBlogs->name = 'manage_admin_blogs';
		$manageBlogs->display_name = 'Manage Admin Blogs';
		$manageBlogs->save();

		$manageStores = new Permission;
		$manageStores->name = 'manage_admin_stores';
		$manageStores->display_name = 'Manage Admin Stores';
		$manageStores->save();

		$manageOpportunites = new Permission;
		$manageOpportunites->name = 'manage_admin_opportunities';
		$manageOpportunites->display_name = 'Manage Admin Opportunities';
		$manageOpportunites->save();

		$admin->perms()->sync(array($managePosts->id, $manageUsers->id,
								$manageBlogs->id, $manageStores->id, $manageOpportunites->id));

		$moderator->perms()->sync(array($managePosts->id,
			$manageBlogs->id, $manageOpportunites->id));
	}

}