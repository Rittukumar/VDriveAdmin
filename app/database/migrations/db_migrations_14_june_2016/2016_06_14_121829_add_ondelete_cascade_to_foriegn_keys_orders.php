<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOndeleteCascadeToForiegnKeysOrders extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropForeign('orders_buyer_id_foreign');
			$table->foreign('buyer_id')
				  ->references('id')->on('buyers')
				  ->onDelete('cascade');

		    $table->dropForeign('orders_store_id_foreign');
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			$table->dropForeign('orders_current_status_id_foreign');
			$table->foreign('current_status_id')
				  ->references('id')->on('order_status_enum')
				  ->onDelete('cascade');
		});

		Schema::table('order_items', function(Blueprint $table)
		{
			$table->dropForeign('order_items_order_id_foreign');
			$table->foreign('order_id')
				  ->references('id')->on('orders')
				  ->onDelete('cascade');

		});

		Schema::table('order_payments', function(Blueprint $table)
		{
			$table->dropForeign('order_payments_order_id_foreign');
			$table->foreign('order_id')
				  ->references('id')->on('orders')
				  ->onDelete('cascade');

		    $table->dropForeign('order_payments_payment_mode_id_foreign');
			$table->foreign('payment_mode_id')
				  ->references('id')->on('payment_mode')
				  ->onDelete('cascade');

		});

		Schema::table('order_status_histories', function(Blueprint $table)
		{
			$table->dropForeign('order_status_histories_order_id_foreign');
			$table->foreign('order_id')
				  ->references('id')->on('orders')
				  ->onDelete('cascade');

		    $table->dropForeign('order_status_histories_status_id_foreign');
			$table->foreign('status_id')
				  ->references('id')->on('order_status_enum')
				  ->onDelete('cascade');

		});

		Schema::table('order_item_status_histories', function(Blueprint $table)
		{
			$table->dropForeign('order_item_status_histories_order_item_id_foreign');
			$table->foreign('order_item_id')
				  ->references('id')->on('order_items')
				  ->onDelete('cascade');

		    $table->dropForeign('order_item_status_histories_status_id_foreign');
			$table->foreign('status_id')
				  ->references('id')->on('order_status_enum')
				  ->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('orders', function(Blueprint $table)
		{
			$table->dropForeign('orders_buyer_id_foreign');
			$table->dropForeign('orders_store_id_foreign');
			$table->dropForeign('orders_current_status_id_foreign');

		});

		Schema::table('order_items', function(Blueprint $table)
		{
			$table->dropForeign('order_items_order_id_foreign');

		});

		Schema::table('order_payments', function(Blueprint $table)
		{
			$table->dropForeign('order_payments_order_id_foreign');
			$table->dropForeign('order_payments_payment_mode_id_foreign');

		});

		Schema::table('order_status_histories', function(Blueprint $table)
		{
			$table->dropForeign('order_status_histories_order_id_foreign');
			$table->dropForeign('order_status_histories_status_id_foreign');

		});

		Schema::table('order_item_status_histories', function(Blueprint $table)
		{
			$table->dropForeign('order_item_status_histories_order_item_id_foreign');
			$table->dropForeign('order_item_status_histories_status_id_foreign');

		});
	}

}
