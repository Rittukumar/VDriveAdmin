<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContractAggreementToStoreBusinessInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('store_business_info', function(Blueprint $table)
		{
			$table->integer('contract_aggreement')->unsigned()->default(0); 
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('store_business_info', function(Blueprint $table)
		{
			$table->dropColumn('contract_aggreement');
		});
	}

}
