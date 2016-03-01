<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPostAddNewColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
				DB::statement('set foreign_key_checks=0');
		DB::statement('
						alter table posts
									add column cat_id integer unsigned after classification_id,
								 	add column sub_cat_id integer unsigned after cat_id;
					');
				DB::statement('set foreign_key_checks=1');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('set foreign_key_checks=0');	
		DB::statement('
				 alter table posts
				  		drop column cat_id,
				 		drop column sub_cat_id;
		');
		DB::statement('set foreign_key_checks=1');
	}

}
