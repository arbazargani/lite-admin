<?php

use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Setting: Price Counter
        DB::table('settings')->insert([
            'name' => 'price_calculation_method',
            'value' => 'custom',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: Buy Dollar Price
        DB::table('settings')->insert([
            'name' => 'dollar_price_buy',
            'value' => '23156',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: Sell Dollar Price
        DB::table('settings')->insert([
            'name' => 'dollar_price_sell',
            'value' => '20000',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: user_authorization_success_message
        DB::table('settings')->insert([
            'name' => 'user_authorization_success_message',
            'value' => 'کاربر گرامی، مدارک شما تایید شد. هم اکنون می‌توانید از تمامی امکانات سامانه استفاده کنید.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: user_authorization_failed_message
        DB::table('settings')->insert([
            'name' => 'user_authorization_failed_message',
            'value' => 'کاربر گرامی، مدارک شما تایید نشده است. لطفا مجدد برای احراز هویت درخواست بدهید.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: user_authorization_needed_message
        DB::table('settings')->insert([
            'name' => 'user_authorization_needed_message',
            'value' => 'کاربر گرامی، دسترسی شما محدود است. لطفا مدارک خود را جهت احراز هویت بارگزاری نمایید.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: BTC WALLET 19is5JsjyPxo2Br1c8ANKt3CgeykqAnxEb
        DB::table('settings')->insert([
            'name' => 'public_btc_wallet',
            'value' => '19is5JsjyPxo2Br1c8ANKt3CgeykqAnxEb',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: USDT WALLET 0x489f617770766f409eb810b80a93d201a6c4ee76
        DB::table('settings')->insert([
            'name' => 'public_usdt_wallet',
            'value' => '0x489f617770766f409eb810b80a93d201a6c4ee76',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Setting: Start time
        DB::table('settings')->insert([
            'name' => 'application_start_time',
            'value' => '07:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: Close time
        DB::table('settings')->insert([
            'name' => 'application_close_time',
            'value' => '23:59',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
