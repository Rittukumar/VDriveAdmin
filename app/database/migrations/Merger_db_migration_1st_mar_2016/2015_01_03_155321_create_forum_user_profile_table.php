<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_user_profile', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('forum_id')->unsigned()->index()->nullable();
			$table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile')->onDelete('cascade');
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
		Schema::table('forum_user_profile', function(Blueprint $table)
		{
			Schema::dropIfExists('forum_user_profile');
		});
	}

}
