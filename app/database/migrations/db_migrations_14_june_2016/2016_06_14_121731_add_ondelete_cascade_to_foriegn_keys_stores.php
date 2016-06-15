<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOndeleteCascadeToForiegnKeysStores extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('store_front_images', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');
		});

		Schema::table('store_owners', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');
		});

		Schema::table('store_business_info', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');
		});

		Schema::table('store_subscription_offer', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			$table->foreign('subscription_id')
				  ->references('id')->on('store_subscription_offer')
				  ->onDelete('cascade');
		});

		Schema::table('store_tags', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			$table->foreign('tag_id')
				  ->references('id')->on('tags')
				  ->onDelete('cascade');
		});

		Schema::table('trending_products', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			$table->foreign('product_sku_id')
				  ->references('id')->on('product_sku')
				  ->onDelete('cascade');
		});

		Schema::table('store_front_info', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			$table->foreign('listing_type_id')
				  ->references('id')->on('store_listing_type')
				  ->onDelete('cascade');
		});

		Schema::table('store_commerce', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');
		});

		Schema::table('store_front_promotions', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');
		});

		Schema::table('store_front_promotion_images', function(Blueprint $table)
		{
			$table->foreign('store_promotion_id')
				  ->references('id')->on('store_front_promotions')
				  ->onDelete('cascade');

			$table->foreign('promotion_image1_id')
				  ->references('id')->on('images')
				  ->onDelete('cascade');

			$table->foreign('promotion_image2_id')
			      ->references('id')->on('images')
			      ->onDelete('cascade');

			$table->foreign('promotion_image3_id')
			      ->references('id')->on('images')
			      ->onDelete('cascade');

			$table->foreign('promotion_image4_id')
			      ->references('id')->on('images')
			      ->onDelete('cascade');
		});

		Schema::table('store_advertising', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			 $table->foreign('recco_subscription_id')
				   ->references('id')->on('recco_subscriptions')
				   ->onDelete('cascade');
		});

		Schema::table('store_status', function(Blueprint $table)
		{
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

			$table->foreign('status_id')
				  ->references('id')->on('store_status_enum')
				  ->onDelete('cascade');

		});

		Schema::table('store_front_comments', function(Blueprint $table)
		{
			$table->dropForeign('store_front_comments_store_id_foreign');
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

            $table->dropForeign('store_front_comments_user_id_foreign');
			$table->foreign('user_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');

            $table->dropForeign('store_front_comments_comment_id_foreign');
			$table->foreign('comment_id')
				  ->references('id')->on('comments')
				  ->onDelete('cascade');
		});
			
		Schema::table('store_front_grades', function(Blueprint $table)
		{
			$table->dropForeign('store_front_grades_store_id_foreign');
			$table->foreign('store_id')
				  ->references('id')->on('stores')
				  ->onDelete('cascade');

            $table->dropForeign('store_front_grades_grader_id_foreign');
			$table->foreign('grader_id')
				  ->references('id')->on('users')
				  ->onDelete('cascade');

            $table->dropForeign('store_front_grades_grade_id_foreign');
			$table->foreign('grade_id')
				  ->references('id')->on('grades')
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
		Schema::table('store_front_images', function(Blueprint $table)
		{
			$table->dropForeign('store_front_images_store_id_foreign');

		});

		Schema::table('store_owners', function(Blueprint $table)
		{
			$table->dropForeign('store_owners_store_id_foreign');

		});

		Schema::table('store_business_info', function(Blueprint $table)
		{
			$table->dropForeign('store_business_info_store_id_foreign');

		});

		Schema::table('store_subscription_offer', function(Blueprint $table)
		{
			$table->dropForeign('store_subscription_offer_store_id_foreign');
			$table->dropForeign('store_subscription_offer_subscription_id_foreign');

		});

		Schema::table('store_tags', function(Blueprint $table)
		{
			$table->dropForeign('store_tags_store_id_foreign');
			$table->dropForeign('store_tags_tag_id_foreign');

		});

		Schema::table('trending_products', function(Blueprint $table)
		{
			$table->dropForeign('trending_products_store_id_foreign');
			$table->dropForeign('trending_products_product_sku_id_foreign');

		});

		Schema::table('store_front_info', function(Blueprint $table)
		{
			$table->dropForeign('store_front_info_store_id_foreign');
			$table->dropForeign('store_front_info_listing_type_id_foreign');

		});

		Schema::table('store_commerce', function(Blueprint $table)
		{
			$table->dropForeign('store_commerce_store_id_foreign');

		});

		Schema::table('store_front_promotions', function(Blueprint $table)
		{
			$table->dropForeign('store_front_promotions_store_id_foreign');

		});

		Schema::table('store_front_promotion_images', function(Blueprint $table)
		{
			$table->dropForeign('store_front_promotion_images_store_promotion_id_foreign');
			$table->dropForeign('store_front_promotion_images_promotion_image1_id_foreign');
			$table->dropForeign('store_front_promotion_images_promotion_image2_id_foreign');
			$table->dropForeign('store_front_promotion_images_promotion_image3_id_foreign');
			$table->dropForeign('store_front_promotion_images_promotion_image4_id_foreign');

		});

		Schema::table('store_advertising', function(Blueprint $table)
		{
			$table->dropForeign('store_advertising_store_id_foreign');
			$table->dropForeign('store_advertising_recco_subscription_id_foreign');

		});

		Schema::table('store_status', function(Blueprint $table)
		{
			$table->dropForeign('store_status_store_id_foreign');
			$table->dropForeign('store_status_status_id_foreign');
            
		});

		Schema::table('store_front_comments', function(Blueprint $table)
		{
			$table->dropForeign('store_front_comments_store_id_foreign');
			$table->dropForeign('store_front_comments_user_id_foreign');
			$table->dropForeign('store_front_comments_comment_id_foreign');

		});

		Schema::table('store_front_grades', function(Blueprint $table)
		{
			$table->dropForeign('store_front_grades_store_id_foreign');
			$table->dropForeign('store_front_grades_grader_id_foreign');
			$table->dropForeign('store_front_grades_grade_id_foreign');

		});
	}

}
