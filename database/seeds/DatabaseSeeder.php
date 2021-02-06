<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(DollarToleranceSeeder::class);
        $this->call(CoinTableSeeder::class);
        $this->call(SeoSettingSeeder::class);
    }
}
