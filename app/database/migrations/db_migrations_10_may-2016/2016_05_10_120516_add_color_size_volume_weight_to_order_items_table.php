<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorSizeVolumeWeightToOrderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('order_items', function(Blueprint $table)
		{
			$table->text('color')->nullable();
			$table->text('size')->nullable();
			$table->text('volume')->nullable();
			$table->text('weight')->nullable();
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_items', function(Blueprint $table)
		{
			$table->dropColumn('color');
			$table->dropColumn('size');
			$table->dropColumn('volume');
			$table->dropColumn('weight');
		});
	}

}
