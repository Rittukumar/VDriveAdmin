<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreOwnersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_owners', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->string('owner_name', 50)->nullable();
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
		Schema::drop('store_owners');
	}

}
