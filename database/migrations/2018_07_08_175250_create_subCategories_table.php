<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubCategoriesTable extends Migration {

	public function up()
	{
		Schema::create('subCategories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->integer('category_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('subCategories');
	}
}