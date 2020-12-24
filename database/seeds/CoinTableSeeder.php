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

        // Coin: Zecash
        DB::table('coins')->insert([
            'name' => 'Zecash',
            'slug' => 'ZECUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coin: Tether
        DB::table('coins')->insert([
            'name' => 'Tether',
            'slug' => 'BUSDUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coin: Ravencoin
        DB::table('coins')->insert([
            'name' => 'Ravencoin',
            'slug' => 'RVNUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Coin: Tether
        DB::table('coins')->insert([
            'name' => 'Ethereum_classic',
            'slug' => 'ETCUSDT',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
