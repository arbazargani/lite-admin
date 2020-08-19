<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('from_coin')->nullable();
            $table->string('amount')->nullable();
            $table->string('to_coin')->nullable();
            $table->string('user_wallet')->nullable();
            $table->string('payable')->nullable();
            $table->string('user_tx_id')->nullable();
            $table->string('admin_tx_id')->nullable();
            $table->string('status')->default('unpaid');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('description')->nullable();
            $table->string('user_paid_at')->nullable();
            $table->string('admin_paid_at')->nullable();
            $table->string('hash')->nullable();
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
        Schema::dropIfExists('exchanges');
    }
}
