<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_location', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('event_id')->unsigned()->index()->nullable();
			$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
			$table->integer('location_id')->unsigned()->index()->nullable();
			$table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
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
		Schema::drop('event_location');
	}

}
