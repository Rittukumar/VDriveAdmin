<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedRequestInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_request_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rfi_id')->unsigned()->index()->nullable();
			$table->foreign('rfi_id')->references('id')->on('request_info');
			$table->integer('classified_id')->unsigned()->index()->nullable();
			$table->foreign('classified_id')->references('id')->on('classifieds');
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
		Schema::drop('classified_request_info');
	}

}
