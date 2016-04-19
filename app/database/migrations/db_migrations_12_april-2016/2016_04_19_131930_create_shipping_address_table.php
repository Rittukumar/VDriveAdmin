<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShippingAddressTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipping_address', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->integer('buyer_id')->unsigned()->index()->nullable();
			$table->string('address_line1', 255)->nullable();
			$table->string('address_line2', 255)->nullable();
			$table->string('address_line3', 255)->nullable();
			$table->string('city', 255)->nullable();
			$table->string('state', 255)->nullable();
			$table->string('country', 255)->nullable();
			$table->string('pincode', 20)->nullable();
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shipping_address');
	}


}
