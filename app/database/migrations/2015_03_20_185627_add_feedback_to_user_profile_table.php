<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFeedbackToUserProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_profile', function(Blueprint $table)
		{
			$table->string('phone', 20)->nullable();
			$table->string('education1')->nullable();
			$table->string('education2')->nullable();
			$table->string('education3')->nullable();
			$table->string('skills')->nullable();
			$table->string('language1')->nullable();
			$table->string('language2')->nullable();
			$table->string('language3')->nullable();
			$table->string('name_organization1')->nullable();
			$table->string('designation1')->nullable();
			$table->string('work_experience1')->nullable();
			$table->string('other_info1')->nullable();

			$table->boolean('want_profile')->nullable();
			$table->enum('profile_page_type', array('personal', 'corporate', 'both'))->nullable();
			$table->string('hobbies')->nullable();
			$table->string('talents')->nullable();
			$table->string('achievements')->nullable();
			$table->string('interests')->nullable();
			$table->boolean('interested_in_content_creation')->nullable();
			$table->boolean('need_customized_profile_page')->nullable();
			$table->boolean('need_marketing_support')->nullable();
			$table->boolean('need_professional_website_link')->nullable();
			$table->string('professional_website_link')->nullable();
			$table->boolean('resume_visibility')->nullable();

			$table->string('website_link')->nullable();
			$table->string('twitter_link')->nullable();
			$table->string('pinterest_link')->nullable();
			$table->string('google_plus_link')->nullable();
			$table->string('youtube_link')->nullable();
			$table->string('other_social_link')->nullable();
			$table->string('ecommerce_link')->nullable();

			$table->string('reference_name1')->nullable();
			$table->string('referrer_email1')->nullable();
			$table->string('referrer_phone1')->nullable();
			$table->string('reference_name2')->nullable();
			$table->string('referrer_email2')->nullable();
			$table->string('referrer_phone2')->nullable();
			$table->string('reference_name3')->nullable();
			$table->string('referrer_email3')->nullable();
			$table->string('referrer_phone3')->nullable();

			$table->boolean('have_physical_online_store')->nullable();
			$table->boolean('want_evezown_store')->nullable();
			$table->boolean('store_without_ecommerce')->nullable();
			$table->boolean('store_front_only')->nullable();
			$table->boolean('store_with_payment_gateway')->nullable();
			$table->boolean('logistics_coordination_assistance')->nullable();
			$table->boolean('post_sales_support')->nullable();
			$table->boolean('need_analytics')->nullable();

			$table->boolean('need_wopportunity_listing')->nullable();
			$table->boolean('full_time_job')->nullable();
			$table->boolean('part_time_job')->nullable();
			$table->boolean('flexi_job')->nullable();
			$table->boolean('short_assignment')->nullable();
			$table->boolean('freelancing_job')->nullable();
			$table->string('interested_industry_sector')->nullable();
			$table->string('hire_through_evezown')->nullable();

			$table->text('feedback')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_profile', function(Blueprint $table)
		{
			
		});
	}

}
