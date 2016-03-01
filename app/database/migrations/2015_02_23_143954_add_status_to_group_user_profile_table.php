<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToGroupUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('group_user_profile', function(Blueprint $table)
		{
			$table->enum('status', ['added', 'requested', 'approved', 'rejected'])->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('group_user_profile', function(Blueprint $table)
		{
			//
		});
	}

}
