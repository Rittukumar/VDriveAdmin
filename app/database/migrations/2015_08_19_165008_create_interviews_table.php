<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInterviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('interviews', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 255);
			$table->text('description')->nullable();
			$table->string('link', 255)->nullable();
			$table->integer('priority')->default(0);
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
		Schema::drop('interviews');
	}

}
