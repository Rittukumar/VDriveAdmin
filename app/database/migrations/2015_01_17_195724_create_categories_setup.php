<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesSetup extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('category_name');
			$table->integer('section_id')->unsigned()->nullable();
			$table->foreign('section_id')->references('id')->on('evezown_sections')
				->onDelete('cascade');
		});

		Schema::create('sub_categories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subcategory_name');
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')->on('categories')
							->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('categories', function (Blueprint $table) {
			$table->dropForeign('categories_section_id_foreign');
		});

		Schema::table('sub_categories', function (Blueprint $table) {
			$table->dropForeign('sub_categories_category_id_foreign');
		});

		Schema::drop('sub_categories');
		Schema::drop('categories');
	}

}
