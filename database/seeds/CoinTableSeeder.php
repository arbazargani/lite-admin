<?php

use Illuminate\Database\Seeder;

class CoinTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Coin: Btc
        DB::table('coins')->insert([
            'name' => 'Bitcoin',
            'slug' => 'BTCUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coin: Ltc
        DB::table('coins')->insert([
            'name' => 'Litecoin',
            'slug' => 'LTCUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coin: Eth
        DB::table('coins')->insert([
            'name' => 'Ethereum',
            'slug' => 'ETHUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
