<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
//            $table->id();
            $table->bigIncrements('id');
            $table->string('trans_id');
            $table->string('order_id')->nullable();
            $table->unsignedBigInteger('receipt_id')->unsigned();
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->bigInteger('amount')->nullable();
            $table->string('card_holder')->nullable();
            $table->string('status')->default('unpaid');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('receipt_id')->references('id')->on('receipts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
