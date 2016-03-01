<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductSkuTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_sku', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->unsigned()->index()->nullable();
			$table->foreign('product_id')->references('id')->on('products');
			$table->decimal('price', 8, 2)->nullable();
			$table->decimal('discount', 5, 2)->nullable();
			$table->decimal('tax', 5, 2)->nullable();
			$table->decimal('shipping_charge', 5, 2)->nullable();
			$table->string('size', 20)->nullable();
			$table->string('color', 9)->nullable();
			$table->decimal('weight', 5, 2)->nullable();
			$table->decimal('volume', 5, 2)->nullable();
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
		Schema::drop('product_sku');
	}

}
