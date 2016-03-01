<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('classified_id')->unsigned()->nullable();
			$table->foreign('classified_id')->references('id')->on('classifieds');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('classified_comments');
	}

}
