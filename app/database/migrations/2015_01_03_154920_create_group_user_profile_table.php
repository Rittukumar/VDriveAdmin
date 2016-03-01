<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_user_profile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_id')->unsigned()->index()->nullable();
			$table->foreign('group_id')->references('id')->on('groups');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile');
			$table->timestamps();
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
			Schema::dropIfExists('group_user_profile');
		});
	}

}
