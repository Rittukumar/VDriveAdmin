<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddNeedResumeUploadToUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_profile', function(Blueprint $table)
		{
			$table->boolean('need_resume_upload')->nullable();
			$table->string('favourite_topic', 255)->nullable();
		});

		DB::statement('ALTER TABLE user_profile MODIFY COLUMN other_ideas VARCHAR(255)');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_profile', function(Blueprint $table)
		{

		});
	}

}
