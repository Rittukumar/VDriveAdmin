<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUnsignedToStatusIdInStoreStatusColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('store_status', function($table) {
	        DB::statement("ALTER TABLE `store_status` CHANGE COLUMN `status_id` `status_id` INT(11) UNSIGNED NOT NULL");
	    });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('store_status', function($table) {
	        DB::statement("ALTER TABLE `store_status` CHANGE COLUMN `status_id` `status_id` INT(11) NOT NULL");
	    });
	}

}
