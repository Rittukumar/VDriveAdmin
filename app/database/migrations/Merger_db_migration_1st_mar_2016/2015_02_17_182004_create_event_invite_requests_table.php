<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventInviteRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_invites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('friend_user_id')->unsigned()->index()->nullable();
			$table->foreign('friend_user_id')->references('id')->on('users');
			$table->integer('event_id')->unsigned()->index()->nullable();
			$table->foreign('event_id')->references('id')->on('events');
			$table->enum('rsvp', array('yes', 'no', 'maybe'))->nullable();
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
		Schema::drop('event_invites');
	}

}
