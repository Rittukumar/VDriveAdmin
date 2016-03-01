<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBuyerShippingAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('buyer_shipping_addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('buyer_id')->unsigned()->index()->nullable();
			$table->foreign('buyer_id')->references('id')->on('buyers');
			$table->string('address_line1', 255)->nullable();
			$table->string('address_line2', 255)->nullable();
			$table->string('address_line3', 255)->nullable();
			$table->string('city', 255)->nullable();
			$table->string('state', 255)->nullable();
			$table->string('country', 255)->nullable();
			$table->string('pincode', 20)->nullable();
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
		Schema::drop('buyer_shipping_addresses');
	}

}
