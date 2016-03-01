<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RemoveStoreCategoryIdFromStoreFrontInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('store_front_info', function(Blueprint $table)
		{
			Schema::table('store_front_info', function (Blueprint $table) {
				$table->dropForeign('store_front_info_store_category_id_foreign');
				$table->dropForeign('store_front_info_store_subcategory_id_foreign');
			});

            $table->dropColumn('store_category_id');
            $table->dropColumn('store_subcategory_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('store_front_info', function(Blueprint $table)
		{
            $table->integer('store_category_id')->unsigned()->index()->nullable();
            $table->foreign('store_category_id')->references('id')->on('categories');
            $table->integer('store_subcategory_id')->unsigned()->index()->nullable();
            $table->foreign('store_subcategory_id')->references('id')->on('sub_categories');
		});
	}

}
