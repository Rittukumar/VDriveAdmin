<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreSubscriptionTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_subscription_type', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name', 30);
            $table->string('value', 10)->nullable();
            $table->string('price', 20)->nullable();
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
		Schema::drop('store_subscription_type');
	}

}
