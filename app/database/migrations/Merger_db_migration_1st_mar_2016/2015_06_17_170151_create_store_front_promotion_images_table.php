<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreFrontPromotionImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_front_promotion_images', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('store_promotion_id')->unsigned()->index()->nullable();
            $table->foreign('store_promotion_id')->references('id')->on('store_front_promotions');
            $table->integer('promotion_image1_id')->unsigned()->index()->nullable();
            $table->foreign('promotion_image1_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('promotion_image2_id')->unsigned()->index()->nullable();
            $table->foreign('promotion_image2_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('promotion_image3_id')->unsigned()->index()->nullable();
            $table->foreign('promotion_image3_id')->references('id')->on('images')->onDelete('cascade');
            $table->integer('promotion_image4_id')->unsigned()->index()->nullable();
            $table->foreign('promotion_image4_id')->references('id')->on('images')->onDelete('cascade');
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
		Schema::drop('store_front_promotion_images');
	}

}
