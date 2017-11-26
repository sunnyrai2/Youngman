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
            $table->integer('location_id')->unsigned();
            $table->string('item_code');
            $table->integer('ok_quantity')->default(0);
            $table->integer('damaged_quantity')->default(0);
            $table->integer('missing_quantity')->default(0);
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('item_code')->references('code')->on('items');
            $table->unique(['location_id', 'item_code']);
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
