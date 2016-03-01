<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuyersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buyers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 30)->nullable();
			$table->string('phone', 30)->nullable();
			$table->string('code', 25)->nullable();
			$table->smallInteger('status')->nullable();
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
		Schema::drop('buyers');
	}

}
