<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{

    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type', array('cash', 'paypal'));
            $table->integer('profile_id')->unsigned();
            $table->string('payer_id')->nullable();
            $table->integer('order_id')->unsigned();
            $table->timestamps();
            $table->string('other')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('payments');
    }
}