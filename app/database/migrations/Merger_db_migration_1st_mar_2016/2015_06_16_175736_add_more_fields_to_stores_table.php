<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMoreFieldsToStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('stores', function(Blueprint $table)
		{
			$table->string('registered_address', 200)->nullable();
            $table->boolean('own_a_physical_store')->nullable();
            $table->string('license_info', 100)->nullable();
 		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stores', function(Blueprint $table) {

        });
	}

}
