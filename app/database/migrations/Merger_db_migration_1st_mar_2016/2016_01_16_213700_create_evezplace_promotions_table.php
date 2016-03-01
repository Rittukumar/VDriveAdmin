<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvezplacePromotionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evezplace_promotions', function(Blueprint $table)
		{
			$table->increments('id');

			$table->string('left_small_caption', 100)->nullable();
			$table->string('left_large_caption', 255)->nullable();
			$table->string('left_button_text', 255)->nullable();
			$table->string('left_link', 255)->nullable();
			$table->integer('left_image_id')->unsigned()->index()->nullable();
			$table->foreign('left_image_id')->references('id')->on('images');

			$table->string('right_top_small_caption', 100)->nullable();
			$table->string('right_top_large_caption', 255)->nullable();
			$table->string('right_top_button_text', 255)->nullable();
			$table->string('right_top_link', 255)->nullable();
			$table->integer('right_top_image_id')->unsigned()->index()->nullable();
			$table->foreign('right_top_image_id')->references('id')->on('images');

			$table->string('right_bottom_small_caption', 100)->nullable();
			$table->string('right_bottom_large_caption', 255)->nullable();
			$table->string('right_bottom_button_text', 255)->nullable();
			$table->string('right_bottom_link', 255)->nullable();
			$table->integer('right_bottom_image_id')->unsigned()->index()->nullable();
			$table->foreign('right_bottom_image_id')->references('id')->on('images');

			$table->integer('evezown_section_id')->unsigned()->nullable();
			$table->foreign('evezown_section_id')->references('id')->on('evezown_sections');

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
		Schema::drop('evezplace_promotions');
	}

}
