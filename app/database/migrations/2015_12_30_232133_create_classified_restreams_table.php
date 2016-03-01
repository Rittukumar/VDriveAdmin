<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedRestreamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_restreams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('classified_id')->unsigned()->nullable();
			$table->foreign('classified_id')->references('id')->on('classifieds');
			$table->integer('post_id')->unsigned()->nullable();
			$table->foreign('post_id')->references('id')->on('posts');
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users');
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
		Schema::drop('classified_restreams');
	}

}
