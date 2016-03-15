<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterInvitesAddNewColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE invites 
						ADD COLUMN reminder INTEGER UNSIGNED NOT NULL DEFAULT 0 AFTER updated_at
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
				 alter table invites
				  		DROP COLUMN reminder
		');
	}

}
