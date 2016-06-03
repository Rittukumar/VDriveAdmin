<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductPackageExpiryToProductSku extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('product_sku', function(Blueprint $table)
		{
			$table->date('package_date')->nullable();
			$table->date('expiry_date')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->dropColumn('package_date');
		$table->dropColumn('expiry_date');
	}

}
