<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_line_id')->unsigned()->index()->nullable();
			$table->foreign('product_line_id')->references('id')->on('product_line');
			$table->string('title', 200);
			$table->text('description')->nullable();
			$table->text('delivery_condition')->nullable();
			$table->text('shipment_condition')->nullable();
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
		Schema::drop('products');
	}

}
