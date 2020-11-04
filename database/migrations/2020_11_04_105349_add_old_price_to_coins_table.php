<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOldPriceToCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coins', function (Blueprint $table) {
            $table->string('ahead_usd_price_1')->after('ahead_usd_price')->default(0)->nullable();
            $table->string('ahead_usd_price_2')->after('ahead_usd_price_1')->default(0)->nullable();
            $table->string('ahead_usd_price_3')->after('ahead_usd_price_2')->default(0)->nullable();
            $table->string('ahead_usd_price_4')->after('ahead_usd_price_3')->default(0)->nullable();
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
            $table->dropColumn('ahead_usd_price_1');
            $table->dropColumn('ahead_usd_price_2');
            $table->dropColumn('ahead_usd_price_3');
            $table->dropColumn('ahead_usd_price_4');
        });
    }
}
