<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDollarTolerance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('settings', function (Blueprint $table) {
        //     $table->string('dollar_price_buy_tolerance')->nullable();
        //     $table->string('dollar_price_sell_tolerance')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('settings', function (Blueprint $table) {
        //     $table->dropColumn('dollar_price_buy');
        //     $table->dropColumn('dollar_price_sell');
        // });
    }
}
