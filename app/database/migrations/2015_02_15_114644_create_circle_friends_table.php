<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCircleFriendsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('circle_friends', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('friend_user_id')->unsigned()->nullable();
			$table->foreign('friend_user_id')->references('id')->on('user_profile');
			$table->integer('circle_id')->unsigned()->nullable();
			$table->foreign('circle_id')->references('id')->on('circles');
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
		Schema::drop('circle_friends');
	}

}
