<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreAdvertisingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_advertising', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->boolean('store_front_to_personal_profile')->nullable();
            $table->integer('recco_subscription_id')->unsigned()->index()->nullable();
            $table->foreign('recco_subscription_id')->references('id')->on('recco_subscriptions')->onDelete('cascade');
            $table->string('store_price_list', 100)->nullable();
            $table->string('store_facebook_link', 200)->nullable();
            $table->string('store_twitter_link', 200)->nullable();
            $table->string('store_linkedin_link', 200)->nullable();
            $table->string('store_website_link', 200)->nullable();
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
		Schema::drop('store_advertising');
	}

}
