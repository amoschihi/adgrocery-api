<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('dateC');
            $table->double('total')->nullable();
            $table->enum('status', array('new', 'hold', 'shipped', 'delivered', 'closed'));
            $table->integer('profile_id')->unsigned();
            $table->date('shipped')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}