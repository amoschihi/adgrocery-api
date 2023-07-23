<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeliveryTypesTable extends Migration
{

    public function up()
    {
        Schema::create('delivery_types', function (Blueprint $table) {
            $table->increments('id');
            $table->text('info')->nullable();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('delivery_types');
    }
}