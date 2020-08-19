<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
//            $table->id();
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->unsigned();
            $table->string('amount')->nullable();
            $table->string('wallet')->nullable();
            $table->string('payable')->nullable();
            $table->string('status')->default('unpaid');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('description')->nullable();
            $table->string('paid_at')->nullable();
            $table->string('admin_action')->default('waiting');
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
        Schema::dropIfExists('receipts');
    }
}
