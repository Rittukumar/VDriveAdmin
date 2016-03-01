<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagePostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('image_id')->unsigned()->index()->nullable();
			$table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
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
		Schema::table('post_images', function(Blueprint $table)
		{
			Schema::dropIfExists('post_images');
		});
	}

}
