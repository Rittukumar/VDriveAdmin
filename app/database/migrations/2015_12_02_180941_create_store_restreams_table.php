<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreRestreamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_restreams', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->nullable();
			$table->foreign('store_id')->references('id')->on('stores');
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
		Schema::drop('store_restreams');
	}

}
