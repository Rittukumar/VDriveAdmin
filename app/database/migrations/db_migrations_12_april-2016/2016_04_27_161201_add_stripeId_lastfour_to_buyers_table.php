<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStripeIdLastfourToBuyersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('buyers', function(Blueprint $table)
		{
			$table->string('stripe_id', 255);
			$table->string('last_four', 4);

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->dropColumn('stripe_id');
		$table->dropColumn('last_four');
	}

}
