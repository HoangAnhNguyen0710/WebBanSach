<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->integer('status');
            $table->string('customer_name');
            $table->string('customer_address');
            $table->string('customer_contact');
            $table->bigInteger('price');
            $table->bigInteger('discount_price');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('applied_voucher')->nullable();

            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('applied_voucher')->references('id')->on('vouchers')->onDelete('cascade');
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
