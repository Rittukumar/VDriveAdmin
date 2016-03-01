<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_activities', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile');
			$table->integer('event_id')->unsigned()->index()->nullable();
			$table->foreign('event_id')->references('id')->on('events');
			$table->text('comment')->nullable();
			$table->timestamps();
		});

		Schema::create('event_activity_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('image_id')->unsigned()->index()->nullable();
			$table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
			$table->integer('event_activity_id')->unsigned()->index()->nullable();
			$table->foreign('event_activity_id')->references('id')->on('event_activities')->onDelete('cascade');
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
		Schema::drop('event_activity_images');
		Schema::drop('event_activities');
	}

}
