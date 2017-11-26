<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BundleItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bundle_items', function (Blueprint $table) {
            $table->string('bundle_code');
            $table->string('item_code');
            $table->integer('quantity')->default(0);
            $table->timestamps();

            $table->foreign('bundle_code')->references('code')->on('items');
            $table->foreign('item_code')->references('code')->on('items');
            $table->unique(['bundle_code', 'item_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bundle_items');
    }
}
