<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('author_id')->unsigned()->nullable();
			$table->foreign('author_id')->references('id')->on('user_profile');
			$table->integer('counts_id')->unsigned()->nullable();
			$table->foreign('counts_id')->references('id')->on('counts');
			$table->string('title', 30);
			$table->text('content')->nullable();
			$table->enum('status', array('published', 'draft', 'outdated'));
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
		Schema::table('blog', function(Blueprint $table)
		{
			Schema::dropIfExists('blog');
		});
	}

}
