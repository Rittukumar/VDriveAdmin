<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('street_address')->nullable();
			$table->string('street_address2')->nullable();
			$table->string('locality')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('state_code', 5)->nullable();
			$table->string('country')->nullable();
			$table->string('country_code', 5)->nullable();
			$table->string('zip')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
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
		Schema::drop('locations');
	}

}
