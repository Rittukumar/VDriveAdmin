<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_grades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('classified_id')->unsigned()->nullable();
			$table->foreign('classified_id')->references('id')->on('classifieds');
			$table->integer('grader_id')->unsigned()->nullable();
			$table->foreign('grader_id')->references('id')->on('users');
			$table->integer('grade_id')->unsigned()->nullable();
			$table->foreign('grade_id')->references('id')->on('grades');
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
		Schema::drop('classified_grades');
	}

}
