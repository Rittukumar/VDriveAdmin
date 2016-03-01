<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassifiedsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classifieds', function(Blueprint $table)
		{
			$table->increments('id');
            $table->enum('classified_type', array('products', 'services'));
            $table->integer('classified_category_id')->unsigned()->index()->nullable();
            $table->foreign('classified_category_id')->references('id')->on('categories');
            $table->integer('classified_subcategory_id')->unsigned()->index()->nullable();
            $table->foreign('classified_subcategory_id')->references('id')->on('sub_categories');
            $table->string('title', 50);
            $table->text('description')->nullable();
            $table->string('deal_description', 100)->nullable();
            $table->integer('layout_type')->nullable();
            $table->integer('classified_for')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_my_eves')->nullable();
            $table->boolean('is_my_circles')->nullable();
            $table->boolean('is_only_me')->nullable();
            $table->boolean('is_recco_it_channel')->nullable();
            $table->boolean('is_open_to_public')->nullable();
            $table->boolean('is_add_enquiry')->nullable();
            $table->boolean('is_facebook_share')->nullable();
            $table->boolean('is_watsapp_share')->nullable();
            $table->boolean('is_googleplus_share')->nullable();
            $table->boolean('is_twitter_share')->nullable();
            $table->boolean('is_direct_message_share')->nullable();
            $table->boolean('is_gmail_share')->nullable();
            $table->boolean('is_linkedin_share')->nullable();
            $table->boolean('is_email_share')->nullable();
            $table->boolean('is_views_analytics')->nullable();
            $table->boolean('is_enquires_analytics')->nullable();
            $table->boolean('is_sends_analytics')->nullable();
            $table->boolean('is_gradeit_analytics')->nullable();
            $table->boolean('is_visibility_summary_analytics')->nullable();
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
		Schema::drop('classifieds');
	}

}
