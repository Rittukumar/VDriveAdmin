<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductLineTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_line', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->index()->nullable();
			$table->foreign('store_id')->references('id')->on('stores');
			$table->string('title', 100);
			$table->text('description')->nullable();
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
		Schema::drop('product_line');
	}

}
