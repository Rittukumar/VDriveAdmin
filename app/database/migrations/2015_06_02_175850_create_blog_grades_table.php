<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBlogGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blog_grades', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('grade_id')->unsigned()->index()->nullable();
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->integer('blog_id')->unsigned()->index()->nullable();
            $table->foreign('blog_id')->references('id')->on('blog')->onDelete('cascade');
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
		Schema::drop('blog_grades');
	}

}
