<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile');
			$table->integer('group_id')->unsigned()->index()->nullable();
			$table->foreign('group_id')->references('id')->on('groups');
			$table->string('title', 50);
			$table->text('description')->nullable();
			$table->timestamps();
		});

		Schema::create('group_activity_links', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('group_activity_id')->unsigned()->index()->nullable();
			$table->foreign('group_activity_id')->references('id')->on('group_activities')->onDelete('cascade');
			$table->integer('link_id')->unsigned()->index()->nullable();
			$table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
			$table->timestamps();
		});

		Schema::create('group_activity_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('image_id')->unsigned()->index()->nullable();
			$table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
			$table->integer('group_activity_id')->unsigned()->index()->nullable();
			$table->foreign('group_activity_id')->references('id')->on('group_activities')->onDelete('cascade');
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
		Schema::drop('group_activity_links');
		Schema::drop('group_activity_images');
		Schema::drop('group_activities');
	}

}
