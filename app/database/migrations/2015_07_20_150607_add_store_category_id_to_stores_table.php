<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStoreCategoryIdToStoresTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('stores', function(Blueprint $table)
		{
            $table->integer('store_category_id')->unsigned()->index()->nullable();
            $table->foreign('store_category_id')->references('id')->on('categories');
            $table->integer('store_subcategory_id')->unsigned()->index()->nullable();
            $table->foreign('store_subcategory_id')->references('id')->on('sub_categories');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('stores', function(Blueprint $table)
		{
			
		});
	}

}
