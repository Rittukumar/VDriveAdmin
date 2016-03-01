<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activity_type', function(Blueprint $table)
		{
			$table->increments('id');
			$table->enum('type', array('post', 'event', 'friend', 'blog', 'listing', 'store', 'circle', 'forum', 'group'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activity_type', function(Blueprint $table)
		{
			Schema::dropIfExists('activity_type');
		});
	}

}
