<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('rewoice_post_id')->unsigned()->index()->nullable();
			$table->foreign('rewoice_post_id')->references('id')->on('posts');
			$table->integer('owner_id')->unsigned()->index()->nullable();
			$table->foreign('owner_id')->references('id')->on('user_profile');
			$table->string('title', 30);
			$table->text('description')->nullable();
			$table->string('location')->nullable();
			$table->string('price_range')->nullable();
			$table->text('testimonial')->nullable();
			$table->timestamps();
		});

		Schema::table('posts', function($table)
		{
			$table->integer('visibility_id')->unsigned()->index()->nullable();
			$table->foreign('visibility_id')->references('id')->on('visibility');
			$table->integer('post_type_id')->unsigned()->index()->nullable();
			$table->foreign('post_type_id')->references('id')->on('post_type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function (Blueprint $table) {
			$table->dropForeign('posts_rewoice_post_id_foreign');
			$table->dropForeign('posts_grades_owner_id_foreign');
		});

		Schema::dropIfExists('posts');
	}

}
