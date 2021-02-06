<?php

use Illuminate\Database\Seeder;

class DollarToleranceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'name' => 'dollar_price_buy_tolerance',
            'value' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'name' => 'dollar_price_sell_tolerance',
            'value' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
