<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreProductRfqTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_product_rfq', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rfq_id')->unsigned()->index()->nullable();
			$table->foreign('rfq_id')->references('id')->on('store_rfq');
			$table->integer('product_id')->unsigned()->index()->nullable();
			$table->foreign('product_id')->references('id')->on('products');
			$table->date('required_delivery_date')->nullable();
			$table->integer('required_quantity')->nullable();
			$table->date('likely_purchase_date')->nullable();
			$table->string('delivery_city')->nullable();
			$table->string('delivery_state')->nullable();
			$table->string('delivery_country')->nullable();
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
		Schema::drop('store_product_rfq');
	}

}
