<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallanItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challan_items', function (Blueprint $table) {
            $table->integer('status');
            $table->integer('challan_id')->unsigned();
            $table->string('item_code');
            $table->integer('ok_quantity')->unsigned();
            $table->integer('damaged_quantity')->unsigned();
            $table->integer('missing_quantity')->unsigned();
            $table->decimal('unit_price');
            $table->decimal('total_price');
            $table->timestamps();

            //$table->primary( 'challan_id', 'item_code');
            //$table->foreign('challan_id')->references('id')->on('challans');
            //$table->foreign('item_code')->references('code')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challan_items');
    }
}
