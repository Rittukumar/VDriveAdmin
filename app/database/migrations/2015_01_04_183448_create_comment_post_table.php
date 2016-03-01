<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('comment_id')->unsigned()->index()->nullable();
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
			$table->integer('post_id')->unsigned()->index()->nullable();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('owner_id')->unsigned()->index()->nullable();
			$table->foreign('owner_id')->references('user_id')->on('user_profile')->onDelete('cascade');
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
		Schema::table('post_comments', function(Blueprint $table)
		{
			Schema::dropIfExists('post_comments');
		});
	}

}
