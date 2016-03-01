<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbumCommentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('album_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('album_id')->unsigned()->index()->nullable();
			$table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
			$table->integer('comment_id')->unsigned()->index()->nullable();
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
			$table->integer('user_id')->unsigned()->index()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile')->onDelete('cascade');
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
		Schema::table('album_comments', function(Blueprint $table)
		{
			Schema::dropIfExists('album_comments');
		});
	}

}
