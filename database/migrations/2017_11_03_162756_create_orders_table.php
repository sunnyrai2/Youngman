<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('quotation_id')->unsigned();
            $table->foreign('quotation_id')->references('id')->on('quotations');

            $table->integer('quickbooks_id')->unique();
            $table->string('job_order')->unique();
            $table->string('po_no');

            $table->integer('place_of_supply')->unsigned();
            $table->foreign('place_of_supply')->references('id')->on('states');

            $table->integer('first_bill')->nullable();

            $table->string('security_etter')->nullable();
            $table->string('rental_advance')->nullable();
            $table->string('rental_order')->nullable();
            $table->string('security_cheque')->nullable();

            $table->timestamp('released_at')->nullable();
            $table->string('godown_id')->nullable();
            $table->decimal('security_amt', 12,2)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
