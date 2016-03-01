<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreFrontGradesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_front_grades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->nullable();
			$table->foreign('store_id')->references('id')->on('stores');
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
		Schema::drop('store_front_grades');
	}

}
