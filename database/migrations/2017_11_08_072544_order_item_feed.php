<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrderItemFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('order_item_feed', function (Blueprint $table) {
            $table->increments('id');
            $table->string('job_order');
            $table->string('item_code');
            $table->integer('quantity');
            //$table->unique('job_order', 'item_code');
            $table->foreign('item_code')->references('code')->on('items');
            $table->foreign('job_order')->references('job_order')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_item_feed');
    }
}
