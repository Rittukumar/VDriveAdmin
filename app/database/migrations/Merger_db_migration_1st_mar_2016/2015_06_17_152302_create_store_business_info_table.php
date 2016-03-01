<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreBusinessInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_business_info', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->string('pan_number', 50)->nullable();
            $table->string('tin_number', 50)->nullable();
            $table->string('vat_number', 50)->nullable();
            $table->string('tan_number', 50)->nullable();
            $table->string('service_tax_id', 50)->nullable();
            $table->string('store_contract_file', 200)->nullable();
            $table->string('billing_info_name', 50)->nullable();
            $table->string('billing_info_address', 200)->nullable();
            $table->string('billing_info_contact_number', 200)->nullable();
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
		Schema::drop('store_business_info');
	}

}
