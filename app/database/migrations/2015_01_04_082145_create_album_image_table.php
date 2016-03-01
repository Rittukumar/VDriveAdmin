<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbumImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('album_images', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('album_id')->unsigned()->index()->nullable();
			$table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
			$table->integer('image_id')->unsigned()->index()->nullable();
			$table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
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
		Schema::table('album_images', function(Blueprint $table)
		{
			Schema::dropIfExists('album_images');
		});
	}

}
