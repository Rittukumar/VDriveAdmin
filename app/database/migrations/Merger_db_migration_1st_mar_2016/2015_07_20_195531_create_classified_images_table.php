<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_images', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('classified_id')->unsigned()->index()->nullable();
            $table->foreign('classified_id')->references('id')->on('classifieds');
            $table->string('title_image_name', 255)->nullable();
            $table->string('body_image1_name', 255)->nullable();
            $table->string('body_image2_name', 255)->nullable();
            $table->string('body_image3_name', 255)->nullable();
            $table->string('body_image4_name', 255)->nullable();
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
		Schema::drop('classified_images');
	}

}
