<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
//            $table->id();
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('rule')->default('user');
            $table->string('status')->default('suspended');
            $table->string('birth_certificate')->nullable();
            $table->string('person_birth_certificate')->nullable(); //new item
            $table->string('national_card')->nullable();
            $table->string('person_national_card')->nullable();     //new item
            $table->string('national_code')->nullable()->uniqe();
            $table->string('phone_number')->nullable()->uniqe();
            $table->string('home_number')->nullable()->uniqe();              //new item
            $table->string('credit_card')->nullable()->uniqe();              //new item
            $table->string('credit_account')->nullable()->uniqe();           //new item
            $table->string('sheba_account')->nullable()->uniqe();           //new item
            $table->string('home_address')->nullable();             //new item
            $table->string('wallet_address')->nullable()->uniqe();
            $table->string('amount')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
