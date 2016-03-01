<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostRewoiceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_rewoice', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('post_id')->unsigned()->index()->nullable();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('rewoicer_id')->unsigned()->index()->nullable();
			$table->foreign('rewoicer_id')->references('user_id')->on('user_profile')->onDelete('cascade');
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
		Schema::table('post_rewoice', function (Blueprint $table) {
			$table->dropForeign('post_rewoice_post_id_foreign');
			$table->dropForeign('post_rewoice_rewoicer_id_foreign');
		});

		Schema::drop('post_rewoice');
	}

}
