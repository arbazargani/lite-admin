<?php

use Illuminate\Database\Seeder;

class SeoSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->insert([
            'name' => 'application_index_meta_title',
            'value' => 'کریپتاینر - خرید و فروش ارز دیجیتال',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'name' => 'application_index_meta_keyword',
            'value' => 'کریپتاینر سامانه خرید و فروش ارز دیجیتال با پشتیبانی از خرید و فروش بیت کوین، خرید و فروش لایت کوین، خرید و فروش اتریوم، خرید و فروش تتر، خرید و فروش بیت کوین کش',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'name' => 'application_index_meta_description',
            'value' => 'کریپتاینر, خرید و فروش ارز دیجیتال, بیت کوین, لایت کوین, اتریوم, تتر, خرید ارز دیجیتال, فروش ارز دیجیتال, کریپتوکارنسی, بیت کوین چیست, ارز دیجیتال چیست',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'name' => 'application_index_meta_robots',
            'value' => 'follow, index',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
