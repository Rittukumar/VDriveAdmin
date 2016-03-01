<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_items', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->unsigned()->index()->nullable();
			$table->foreign('order_id')->references('id')->on('orders');
			$table->integer('product_id')->nullable();
			$table->integer('quantity')->nullable();
			$table->float('price', 8, 2)->nullable();
			$table->date('expected_shipping_date')->nullable();
			$table->date('expected_delivery_date')->nullable();
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
		Schema::drop('order_items');
	}

}
