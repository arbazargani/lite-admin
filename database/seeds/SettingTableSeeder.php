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
            'value' => 'auto',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Setting: Dollar Price
        DB::table('settings')->insert([
            'name' => 'dollar_price',
            'value' => '9245',
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
    }
}
