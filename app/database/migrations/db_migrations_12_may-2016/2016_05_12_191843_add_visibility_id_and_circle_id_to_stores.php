<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVisibilityIdAndCircleIdToStores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stores', function(Blueprint $table)
		{
			$table->integer('visibility_id')->unsigned()->nullable();
			$table->integer('circle_id')->unsigned()->nullable();
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stores', function(Blueprint $table)
		{
			$table->dropColumn('visibility_id');
			$table->dropColumn('circle_id');
		});
	}

}
