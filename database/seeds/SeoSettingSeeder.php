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
            'value' => 'کریپتاینر',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'name' => 'application_index_meta_keyword',
            'value' => 'کریپتاینر',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('settings')->insert([
            'name' => 'application_index_meta_description',
            'value' => 'کریپتاینر',
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
