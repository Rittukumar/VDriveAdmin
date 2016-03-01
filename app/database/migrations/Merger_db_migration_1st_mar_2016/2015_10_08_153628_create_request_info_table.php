<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('request_info', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 100)->nullable();
			$table->string('mobile', 20)->nullable();
			$table->string('email', 40)->nullable();
			$table->string('city', 50)->nullable();
			$table->boolean('is_contact_email')->nullable();
			$table->boolean('is_contact_phone')->nullable();
			$table->date('required_delivery_date')->nullable();
			$table->integer('required_quantity')->nullable();
			$table->date('likely_purchase_date')->nullable();
			$table->string('delivery_city')->nullable();
			$table->string('delivery_state')->nullable();
			$table->string('delivery_country')->nullable();
			$table->text('other_info')->nullable();
			$table->text('other_feedback')->nullable();
			$table->text('comment')->nullable();
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
		Schema::drop('request_info');
	}

}
