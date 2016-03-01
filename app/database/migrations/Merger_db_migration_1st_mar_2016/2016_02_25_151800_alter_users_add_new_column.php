<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersAddNewColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE users 
						ADD COLUMN blocked TINYINT(1) NOT NULL DEFAULT 0 AFTER updated_at,
		  				ADD COLUMN deleted TINYINT(1) NOT NULL DEFAULT 0 AFTER blocked
					 ');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('
				 alter table users
				  		drop column blocked,
				 		drop column deleted
		');
	}

}
