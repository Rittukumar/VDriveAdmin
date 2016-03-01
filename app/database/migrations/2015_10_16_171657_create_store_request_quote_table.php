<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreRequestQuoteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request_quote', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100);
			$table->string('mobile', 20);
			$table->string('email', 40);
			$table->string('city', 50)->nullable();
			$table->string('state', 50)->nullable();
			$table->string('country', 50)->nullable();
			$table->boolean('is_contact_email')->nullable();
			$table->boolean('is_contact_phone')->nullable();
			$table->text('other_info')->nullable();
			$table->text('other_feedback')->nullable();
			$table->text('comment')->nullable();
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
		Schema::drop('request_quote');
	}

}
