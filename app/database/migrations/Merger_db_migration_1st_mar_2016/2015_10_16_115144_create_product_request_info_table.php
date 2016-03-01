<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductRequestInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_request_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rfi_id')->unsigned()->index()->nullable();
			$table->foreign('rfi_id')->references('id')->on('request_info');
			$table->integer('product_id')->unsigned()->index()->nullable();
			$table->foreign('product_id')->references('id')->on('products');
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
		Schema::drop('product_request_info');
	}

}
