<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReviewsTable extends Migration
{

    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->text('review')->nullable();
            $table->boolean('recommended')->nullable();
            $table->integer('stars')->nullable();
            $table->string('reviewTitle')->nullable();
            $table->integer('profile_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('reviews');
    }
}