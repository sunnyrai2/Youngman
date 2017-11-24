<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location_name');
            $table->string('item_code');
            $table->integer('ok_quantity')->default(0);
            $table->integer('damaged_quantity')->default(0);
            $table->integer('missing_quantity')->default(0);
            $table->timestamps();

            $table->unique(['location_name', 'item_code']);
            $table->foreign('location_name')->references('location_name')->on('locations');
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
        Schema::dropIfExists('location_items');
    }
}
