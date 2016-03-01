<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreFrontInfoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_front_info', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('store_id')->unsigned()->index();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->string('store_caption', 100)->nullable();
            $table->string('store_about_us', 250)->nullable();
            $table->string('target_audience', 100)->nullable();
            $table->string('offerings', 100)->nullable();
            $table->string('motto', 100)->nullable();
            $table->string('vision', 100)->nullable();
            $table->string('purpose', 200)->nullable();
            $table->integer('listing_type_id')->unsigned()->index()->nullable();
            $table->foreign('listing_type_id')->references('id')->on('store_listing_type');
            $table->integer('store_category_id')->unsigned()->index()->nullable();
            $table->foreign('store_category_id')->references('id')->on('categories');
            $table->integer('store_subcategory_id')->unsigned()->index()->nullable();
            $table->foreign('store_subcategory_id')->references('id')->on('sub_categories');
            $table->string('store_city', 200)->nullable();
            $table->string('store_contact_email', 40)->nullable();
            $table->string('store_contact_phone1', 20)->nullable();
            $table->string('store_contact_phone2', 20)->nullable();
            $table->string('store_contact_phone3', 20)->nullable();
            $table->string('store_terms_conditions', 500)->nullable();
            $table->string('store_policies', 500)->nullable();
            $table->string('store_sales_exchange_policy', 500)->nullable();
            $table->string('store_mandatory_disclosure_link1', 200)->nullable();
            $table->string('store_mandatory_disclosure_link2', 200)->nullable();
            $table->string('store_mandatory_disclosure_link3', 200)->nullable();
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
		Schema::drop('store_front_info');
	}

}
