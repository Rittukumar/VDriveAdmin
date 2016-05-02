<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payment_details', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->integer('order_id')->unsigned()->index();
            $table->string('charge_id');
            $table->decimal('price', 10,2);
            $table->string('last_four', 4);
            $table->string('card_type', 20);            
            $table->timestamps();        
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('payment_details');
	}

}
