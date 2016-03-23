<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLastSeenTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('last_seen', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('user_id')->unsigned()->nullable();
			$table->integer('chat_message_id')->unsigned()->nullable();
			
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('chat_message_id')->references('id')->on('chat_messages')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('last_seen');
	}

}
