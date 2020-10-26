<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExchangeLimitationToCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->string('min_ex_limit')->default('0.001');
            $table->string('max_ex_limit')->default('0.3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coins', function (Blueprint $table) {
            //
        });
    }
}
