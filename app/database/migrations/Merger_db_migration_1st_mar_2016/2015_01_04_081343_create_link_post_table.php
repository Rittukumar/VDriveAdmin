<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinkPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_links', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('link_id')->unsigned()->index()->nullable();
			$table->foreign('link_id')->references('id')->on('links')->onDelete('cascade');
			$table->integer('post_id')->unsigned()->index()->nullable();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
		Schema::table('post_links', function(Blueprint $table)
		{
			Schema::dropIfExists('post_links');
		});
	}

}
