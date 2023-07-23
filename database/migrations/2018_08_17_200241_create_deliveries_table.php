<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveriesTable extends Migration {

	public function up()
	{
		Schema::create('deliveries', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('deliveryType_id')->unsigned()->nullable();
			$table->integer('order_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('deliveries');
	}
}