<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductSkuStockTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_sku_stock', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_sku_id')->unsigned()->index()->nullable();
			$table->foreign('product_sku_id')->references('id')->on('product_sku');
			$table->integer('quantity')->default(0);
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
		Schema::drop('product_sku_stock');
	}

}
