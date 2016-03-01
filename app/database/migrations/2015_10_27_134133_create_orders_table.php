<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order_status_enum', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('status', 40)->nullable();
			$table->timestamps();
		});

		Schema::create('orders', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('transaction_id', 15)->nullable();
			$table->integer('buyer_id')->unsigned()->index()->nullable();
			$table->foreign('buyer_id')->references('id')->on('buyers');
			$table->integer('store_id')->unsigned()->index()->nullable();
			$table->foreign('store_id')->references('id')->on('stores');
			$table->integer('current_status_id')->unsigned()->index()->nullable();
			$table->foreign('current_status_id')->references('id')->on('order_status_enum');
			$table->float('total_amount', 8, 2)->nullable();
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
		Schema::drop('orders');
	}

}
