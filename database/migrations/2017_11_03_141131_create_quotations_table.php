<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->string('contact_name')->nullable();
            $table->string('site_name')->nullable();

            $table->decimal('total', 12,2);
            $table->decimal('freight', 12, 2);

            $table->string('billing_address_line');
            $table->string('billing_address_city');
            $table->bigInteger('billing_address_pincode');

            $table->string('delivery_address_line');
            $table->string('delivery_address_city');
            $table->bigInteger('delivery_address_pincode');

            $table->date('delivery_date')->nullable();
            $table->date('pickup_date')->nullable();

            $table->timestamp('converted_at');

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
        Schema::dropIfExists('quotations');
    }
}
