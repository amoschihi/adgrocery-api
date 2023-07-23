<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLineOrdersTable extends Migration {

	public function up()
	{
		Schema::create('line_orders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('quantity')->default('1');
			$table->double('subTotal')->nullable();
			$table->integer('order_id')->unsigned()->nullable();
			$table->integer('product_id')->unsigned();
			$table->integer('profile_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('line_orders');
	}
}