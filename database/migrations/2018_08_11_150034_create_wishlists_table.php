<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWishlistsTable extends Migration {

	public function up()
	{
		Schema::create('wishlists', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('profile_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('wishlists');
	}
}