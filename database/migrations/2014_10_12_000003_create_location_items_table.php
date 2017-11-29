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
            $table->integer('location_id')->unsigned();
            $table->string('item_code');
            $table->integer('ok_quantity')->default(0)->unsigned();
            $table->integer('damaged_quantity')->default(0)->unsigned();
            $table->integer('missing_quantity')->default(0)->unsigned();
            $table->timestamps();

            $table->unique(['location_id', 'item_code']);
            $table->foreign('location_id')->references('id')->on('locations');
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
