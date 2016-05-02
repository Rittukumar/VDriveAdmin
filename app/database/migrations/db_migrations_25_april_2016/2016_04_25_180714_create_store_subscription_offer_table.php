<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreSubscriptionOfferTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_subscription_offer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_id')->unsigned()->index()->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
            $table->integer('amount')->unsigned()->nullable();
            $table->integer('subscription_id')->unsigned()->index()->nullable();
            $table->foreign('subscription_id')->references('store_subscription_id')->on('stores');
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
		Schema::drop('store_subscription_offer');
	}

}
