<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogImageTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_image', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('blog_id')->unsigned()->index()->nullable();
            $table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
            $table->integer('image_id')->unsigned()->index()->nullable();
            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
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
		Schema::drop('blog_image');
	}

}
