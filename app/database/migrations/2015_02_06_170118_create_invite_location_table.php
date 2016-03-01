<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInviteLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invite_location', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('invite_id')->unsigned()->index()->nullable();
			$table->foreign('invite_id')->references('id')->on('invites')->onDelete('cascade');
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
		Schema::drop('invite_location');
	}

}
