<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScreenStaticFieldsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('screen_static_fields', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('screen_id')->unsigned()->nullable();
			$table->string('field_name', 120)->nullable();
			$table->string('field_value', 1024)->nullable();
            $table->timestamps();
            $table->foreign('screen_id')->references('id')->on('screens')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('screen_static_fields');
	}

}
