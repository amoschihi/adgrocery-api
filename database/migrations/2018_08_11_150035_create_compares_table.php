<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateComparesTable extends Migration {

	public function up()
	{
		Schema::create('compares', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('product_id')->unsigned();
			$table->integer('profile_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('compares');
	}
}