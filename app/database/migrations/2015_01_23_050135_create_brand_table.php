<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBrandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('brand', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('sub_cat_id')->unsigned()->index()->nullable();
			$table->foreign('sub_cat_id')->references('id')->on('sub_categories');
			$table->string('title', 30)->nullable();
			$table->string('image_name', 100)->nullable();
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
		Schema::table('brand', function (Blueprint $table) {
			$table->dropForeign('brand_sub_cat_id_foreign');
		});

		Schema::drop('brand');
	}

}
