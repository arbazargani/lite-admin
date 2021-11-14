<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('settings', function (Blueprint $table) {
//            $table->boolean('immediate_close_site')->after('application_start_time')->default(0);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::table('settings', function (Blueprint $table) {
//            $table->dropColumn('immediate_close_site');
//        });
    }
}
