<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTagsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_tags', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('blog_id')->unsigned()->nullable();
			$table->foreign('blog_id')->references('id')->on('blog');
			$table->integer('tag_id')->unsigned()->nullable();
			$table->foreign('tag_id')->references('id')->on('tags');
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
		Schema::table('blog_tags', function(Blueprint $table)
		{
			Schema::dropIfExists('blog_tags');
		});
	}

}
