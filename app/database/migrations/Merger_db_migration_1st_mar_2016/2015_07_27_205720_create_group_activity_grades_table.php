<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroupActivityGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_activity_grades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('grade_id')->unsigned()->index()->nullable();
			$table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
			$table->integer('group_activity_id')->unsigned()->nullable();
			$table->foreign('group_activity_id')->references('id')->on('group_activities');
			$table->integer('grader_id')->unsigned()->nullable();
			$table->foreign('grader_id')->references('id')->on('user_profile');
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
		Schema::drop('group_activity_grades');
	}

}
