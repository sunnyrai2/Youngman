<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('pickup_location');
            $table->string('delivery_location');
            $table->string('challan_type');
            $table->integer('order_id')->unsigned();
            $table->integer('transporter')->unsigned();
            $table->string('gr_no');
            $table->decimal('amount', 12, 2);
            $table->decimal('recieving_amount', 12, 2);
            $table->string('recieving');
            $table->date('recieving_date');
            $table->timestamps();

           // $table->unique('id', 'pickup_location', 'delivery_location', 'job_order');

           // $table->foreign('pickup_location')->references('location_name')->on('locations');
           // $table->foreign('delivery_location')->references('location_name')->on('locations');
           // $table->foreign('job_order')->references('job_order')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challans');
    }
}
