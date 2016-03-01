<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbumImageCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('album_image_comments', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('album_image_id')->unsigned()->index()->nullable();
            $table->foreign('album_image_id')->references('id')->on('album_images')->onDelete('cascade');
            $table->integer('comment_id')->unsigned()->index()->nullable();
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            $table->integer('commenter_id')->unsigned()->index()->nullable();
            $table->foreign('commenter_id')->references('user_id')->on('user_profile')->onDelete('cascade');
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
		Schema::drop('album_image_comments');
	}

}
