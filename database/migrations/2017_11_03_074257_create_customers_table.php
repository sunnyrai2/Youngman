<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quickbooks_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('email');
            $table->bigInteger('phone');
            $table->decimal('credit_limit', 12,2);
            $table->string('billing_address_line');
            $table->string('billing_address_city');
            $table->bigInteger('billing_address_pincode');
            $table->string('mailing_address_line');
            $table->string('mailing_address_city');
            $table->bigInteger('mailing_address_pincode');
            $table->string('gstn');
            $table->boolean('security_etter');
            $table->boolean('rental_advance');
            $table->boolean('rental_order');
            $table->boolean('security_cheque');
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
        Schema::dropIfExists('customers');
    }
}
