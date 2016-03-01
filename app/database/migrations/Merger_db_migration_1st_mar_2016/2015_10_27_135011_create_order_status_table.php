<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_status_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->unsigned()->index()->nullable();
			$table->foreign('order_id')->references('id')->on('orders');
			$table->integer('status_id')->unsigned()->index()->nullable();
			$table->foreign('status_id')->references('id')->on('order_status_enum');
			$table->timestamps();
		});

		Schema::create('order_item_status_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_item_id')->unsigned()->index()->nullable();
			$table->foreign('order_item_id')->references('id')->on('order_items');
			$table->integer('status_id')->unsigned()->index()->nullable();
			$table->foreign('status_id')->references('id')->on('order_status_enum');
			$table->text('status_comment')->nullable();
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
		Schema::drop('order_status_enum');
		Schema::drop('order_statuses');
		Schema::drop('order_item_status_histories');
	}

}
