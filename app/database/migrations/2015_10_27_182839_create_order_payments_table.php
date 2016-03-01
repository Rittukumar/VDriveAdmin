<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_mode', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('description')->nullable();
			$table->timestamps();
		});

		Schema::create('order_payments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('order_id')->unsigned()->index()->nullable();
			$table->foreign('order_id')->references('id')->on('orders');
			$table->integer('payment_mode_id')->unsigned()->index()->nullable();
			$table->foreign('payment_mode_id')->references('id')->on('payment_mode');
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
		Schema::drop('payment_mode');
		Schema::drop('order_payments');
	}

}
