<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('blog_id')->unsigned()->nullable();
			$table->foreign('blog_id')->references('id')->on('blog');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('user_profile');
			$table->integer('comment_id')->unsigned()->nullable();
			$table->foreign('comment_id')->references('id')->on('comments');
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
		Schema::table('blog_comments', function(Blueprint $table)
		{
			Schema::dropIfExists('blog_comments');
		});
	}

}
