<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreFrontImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_front_images', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->integer('profile_image_id')->unsigned()->index()->nullable();
            $table->foreign('profile_image_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('collage_image1_id')->unsigned()->index()->nullable();
            $table->foreign('collage_image1_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('collage_image2_id')->unsigned()->index()->nullable();
            $table->foreign('collage_image2_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('collage_image3_id')->unsigned()->index()->nullable();
            $table->foreign('collage_image3_id')->references('id')->on('images')->onDelete('cascade');
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
		Schema::drop('store_front_images');
	}

}
