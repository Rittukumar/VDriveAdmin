<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCheckDdNumberAndCheckDdDateToOrderPaymentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('order_payments', function(Blueprint $table)
		{
			$table->string('check_dd_number', 100)->nullable();
			$table->date('check_dd_date')->nullable();
			$table->string('status', 20)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('order_payments', function(Blueprint $table)
		{
			$table->dropColumn('check_dd_number');
			$table->dropColumn('check_dd_date');
			$table->dropColumn('status');
		});
	}

}
