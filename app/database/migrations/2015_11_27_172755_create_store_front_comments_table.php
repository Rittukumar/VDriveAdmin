<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreFrontCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_front_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->nullable();
			$table->foreign('store_id')->references('id')->on('stores');
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
		Schema::drop('store_front_comments');
	}

}
