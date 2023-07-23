<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateColorArticlesTable extends Migration {

	public function up()
	{
		Schema::create('color_articles', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('color_id')->unsigned();
			$table->integer('article_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('color_articles');
	}
}