<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('dob_id')->unsigned()->index()->nullable();
			$table->foreign('dob_id')->references('id')->on('dob')->onDelete('cascade');
			$table->string('code')->nullable();
			$table->string('name', 50)->nullable();
			$table->string('surname', 30)->nullable();
			$table->string('email')->nullable();
			$table->string('referrer_name')->nullable();
			$table->string('referrer_email')->nullable();
			$table->boolean('is_evezown_member')->nullable();
			$table->string('facebook_link', 50)->nullable();
			$table->string('linkedin_link', 50)->nullable();
			$table->string('profession', 30)->nullable();
			$table->string('how_hear_evezown', 30)->nullable();
			$table->timestamp('claimed_at')->nullable();
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
		Schema::drop('invites');
	}

}
