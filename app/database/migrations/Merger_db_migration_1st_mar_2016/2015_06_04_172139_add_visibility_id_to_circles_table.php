<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVisibilityIdToCirclesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('circles', function(Blueprint $table)
		{
            $table->integer('visibility_id')->unsigned()->index()->nullable();
            $table->foreign('visibility_id')->references('id')->on('visibility');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('circles', function(Blueprint $table)
		{
			
		});
	}

}
