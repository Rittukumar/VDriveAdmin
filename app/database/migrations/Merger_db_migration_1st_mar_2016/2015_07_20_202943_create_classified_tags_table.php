<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_tags', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('classified_id')->unsigned()->index()->nullable();
            $table->foreign('classified_id')->references('id')->on('classifieds');
            $table->integer('tag_id')->unsigned()->index()->nullable();
            $table->foreign('tag_id')->references('id')->on('tags');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('classified_tags');
	}

}
