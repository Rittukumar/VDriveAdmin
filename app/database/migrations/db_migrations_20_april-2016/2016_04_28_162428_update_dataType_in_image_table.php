<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDataTypeInImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		 DB::statement('ALTER TABLE `images` CHANGE COLUMN `small_image_url`  `small_image_url`  VARCHAR(255);');
	     DB::statement('ALTER TABLE `images` CHANGE COLUMN `medium_image_url` `medium_image_url` VARCHAR(255);');
	     DB::statement('ALTER TABLE `images` CHANGE COLUMN `large_image_url`  `large_image_url`  VARCHAR(255);');
	     DB::statement('ALTER TABLE `images` CHANGE COLUMN `thumbnail_url`    `thumbnail_url`    VARCHAR(255);');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
