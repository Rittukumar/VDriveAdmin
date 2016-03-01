<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_contacts', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('classified_id')->unsigned()->index()->nullable();
            $table->foreign('classified_id')->references('id')->on('classifieds');
            $table->string('phone', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('name', 50)->nullable();
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
		Schema::drop('classified_contacts');
	}

}
