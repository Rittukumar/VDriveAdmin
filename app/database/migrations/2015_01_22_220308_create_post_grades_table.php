<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('post_grades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('grade_id')->unsigned()->index()->nullable();
			$table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
			$table->integer('post_id')->unsigned()->index()->nullable();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->integer('owner_id')->unsigned()->index()->nullable();
			$table->foreign('owner_id')->references('user_id')->on('user_profile')->onDelete('cascade');
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
		Schema::table('post_grades', function (Blueprint $table) {
			$table->dropForeign('post_grades_grade_id_foreign');
			$table->dropForeign('post_grades_post_id_foreign');
			$table->dropForeign('post_grades_owner_id_foreign');
		});

		Schema::drop('post_grades');
	}

}
