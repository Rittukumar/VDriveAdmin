<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('albums', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 30);
			$table->string('description', 100)->nullable();
			$table->integer('tag_id')->unsigned()->index()->nullable();
			$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
			$table->integer('counts_id')->unsigned()->nullable();
			$table->foreign('counts_id')->references('id')->on('counts');
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
		Schema::table('albums', function(Blueprint $table)
		{
			Schema::dropIfExists('albums');
		});
	}

}
