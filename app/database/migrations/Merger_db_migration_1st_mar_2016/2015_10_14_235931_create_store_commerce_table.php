<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreCommerceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_commerce', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->index()->nullable();
			$table->foreign('store_id')->references('id')->on('stores');
			$table->boolean('is_payment_gateway_needed')->nullable();
			$table->string('terms_conditions', 255)->nullable();
			$table->string('billing_address', 255)->nullable();
			$table->string('billing_city', 100)->nullable();
			$table->string('billing_state', 100)->nullable();
			$table->string('billing_country', 100)->nullable();
			$table->string('billing_pincode', 100)->nullable();
			$table->boolean('is_offline_payment')->nullable();
			$table->boolean('is_cash_delivery')->nullable();
			$table->boolean('is_cheque_payment')->nullable();
			$table->string('contact_number', 100)->nullable();
			$table->string('vendor_name', 100)->nullable();
			$table->string('additional_info', 255)->nullable();
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
		Schema::drop('store_commerce');
	}

}
