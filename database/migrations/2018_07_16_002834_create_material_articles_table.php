<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaterialArticlesTable extends Migration {

	public function up()
	{
		Schema::create('material_articles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('article_id')->unsigned();
			$table->integer('material_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('material_articles');
	}
}