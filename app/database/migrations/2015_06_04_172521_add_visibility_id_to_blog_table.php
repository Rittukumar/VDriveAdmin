<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddVisibilityIdToBlogTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('blog', function(Blueprint $table)
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
		Schema::table('blog', function(Blueprint $table)
		{
			
		});
	}

}
