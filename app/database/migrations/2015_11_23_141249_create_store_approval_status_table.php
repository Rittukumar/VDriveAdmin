<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreApprovalStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('store_approval_status', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('store_id')->unsigned()->nullable();
			$table->enum('status', array('Submitted', 'Approved', 'Rejected'))->nullable();
			$table->text('reason')->nullable();
			$table->timestamps();
		});

		Schema::table('store_approval_status', function($table) {
			$table->foreign('store_id')->references('id')->on('stores');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('store_approval_status');
	}

}
