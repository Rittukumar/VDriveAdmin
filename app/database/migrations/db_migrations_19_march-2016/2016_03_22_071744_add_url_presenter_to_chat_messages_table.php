<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUrlPresenterToChatMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('chat_messages', function(Blueprint $table)
        {
            $table->text('urlPresenter')->nullable();
            $table->text('attachments')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropColumn('urlPresenter');
            $table->dropColumn('attachments');
        });
	}

}
