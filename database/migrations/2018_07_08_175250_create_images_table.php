<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration
{

    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('src')->nullable();;
            $table->string('name')->nullable();;
            $table->integer('article_id')->unsigned()->nullable();;
            $table->integer('news_id')->unsigned()->nullable();;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('images');
    }
}