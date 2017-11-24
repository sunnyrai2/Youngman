<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChallanOrderItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('challan_order_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('challan_id')->unsigned();
            $table->string('item_code');
            $table->integer('ok_quantity');
            $table->unique('challan_id', 'item_code');
            $table->foreign('challan_id')->references('id')->on('challans');
            $table->foreign('item_code')->references('code')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challan_order_item');
    }
}
