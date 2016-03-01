<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfileCoverPicTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profile_cover_pic', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('user_id')->on('user_profile')->onDelete('cascade');
			$table->integer('left_image_id')->unsigned()->index()->nullable();
			$table->foreign('left_image_id')->references('id')->on('images')->onDelete('cascade');
			$table->integer('bottom_image_id')->unsigned()->index()->nullable();
			$table->foreign('bottom_image_id')->references('id')->on('images')->onDelete('cascade');
			$table->integer('right_image_id')->unsigned()->index()->nullable();
			$table->foreign('right_image_id')->references('id')->on('images')->onDelete('cascade');
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
		Schema::drop('profile_cover_pic');
	}

}
