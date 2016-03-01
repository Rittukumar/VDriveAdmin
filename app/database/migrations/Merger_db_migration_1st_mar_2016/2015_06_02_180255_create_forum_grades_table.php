<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForumGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('forum_grades', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('grade_id')->unsigned()->index()->nullable();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->integer('forum_id')->unsigned()->index()->nullable();
            $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
            $table->integer('grader_id')->unsigned()->index()->nullable();
            $table->foreign('grader_id')->references('user_id')->on('user_profile')->onDelete('cascade');
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
		Schema::drop('forum_grades');
	}

}
