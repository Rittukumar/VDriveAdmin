<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupActivityCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_activity_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_activity_id')->unsigned()->nullable();
			$table->foreign('group_activity_id')->references('id')->on('group_activities');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile');
			$table->integer('comment_id')->unsigned()->nullable();
			$table->foreign('comment_id')->references('id')->on('comments');
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
		Schema::drop('group_activity_comments');
	}

}
