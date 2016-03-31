<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInterviewImageToInterviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('interviews', function(Blueprint $table)
		{
			$table->string('interview_image', 100)->nullable(); 
     	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('interviews', function(Blueprint $table)
		{
			$table->dropColumn('interview_image');
		});
	}

}
