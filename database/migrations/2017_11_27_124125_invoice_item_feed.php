<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoiceItemFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_item_feed', function (Blueprint $table) {

            $table->string('job_order');
            $table->integer('challan_id')->unsigned();
            $table->string('item_code');
            $table->integer('quantity')->unsigned();

            $table->primary('job_order', 'challan_id', 'item_code');
            $table->foreign('item_code')->references('code')->on('items');
            $table->foreign('job_order')->references('job_order')->on('orders');
            $table->foreign('challan_id')->references('id')->on('challans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_item_feed');
    }
}
