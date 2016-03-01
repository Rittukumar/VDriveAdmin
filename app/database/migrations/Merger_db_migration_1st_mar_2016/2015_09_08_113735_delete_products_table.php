<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

		Schema::table('posts', function (Blueprint $table ) {
			$table->dropForeign('posts_brand_id_foreign');
		});

		Schema::table('product_images', function (Blueprint $table ) {
			$table->dropForeign('product_images_product_id_foreign');
		});

		Schema::table('products', function (Blueprint $table) {
			$table->dropForeign('products_store_id_foreign');
			$table->dropForeign('products_sub_cat_id_foreign');
		});

		Schema::drop('products');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
		});
	}

}
