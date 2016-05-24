<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippingBillingIdToOrdersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->integer('billing_id')->unsigned()->index()->nullable();
			$table->integer('shipping_id')->unsigned()->index()->nullable();
			$table->foreign('billing_id')->references('id')->on('billing_address')->onDelete('cascade');
			$table->foreign('shipping_id')->references('id')->on('shipping_address')->onDelete('cascade');
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropColumn('billing_id');
			$table->dropColumn('shipping_id');
		});
	}

}
