<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisibilityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visibility', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type', 20)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('visibility', function(Blueprint $table)
		{
			Schema::dropIfExists('visibility');
		});
	}

}
