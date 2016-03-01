<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddContentCreationFieldsToUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_profile', function(Blueprint $table)
		{
            $table->boolean('through_blogs')->nullable();
            $table->boolean('through_forums')->nullable();
            $table->boolean('through_events')->nullable();
            $table->boolean('through_recco')->nullable();
            $table->boolean('as_evangelist')->nullable();
            $table->boolean('as_active_writer')->nullable();
            $table->boolean('as_ecommerce')->nullable();
            $table->boolean('resume_path')->nullable();
            $table->boolean('other_ideas')->nullable();
		});
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
