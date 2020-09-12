<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Admin: Alireza Bazargani
         DB::table('users')->insert([
            'name' => 'علیرضا بازرگانی',
            'email' => 'arbazargani1998@gmail.com',
            'password' => bcrypt('adminstrator09308990856'),
            'rule' => 'root',
            'status' => 'verified',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Admin: System operator
        DB::table('users')->insert([
            'name' => 'سیاوش ',
            'email' => 'operator@cryptiner.ir',
            'password' => bcrypt('operator'),
            'rule' => 'admin',
            'status' => 'verified',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         // User: Saeed Khosravi
         DB::table('users')->insert([
            'name' => 'سعید خسروی',
            'email' => 'user@user.ir',
            'password' => bcrypt('user'),
            'rule' => 'user',
            'status' => 'verified',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User: Siamak Sazgar
        DB::table('users')->insert([
            'name' => 'سیامک سازگار',
            'email' => 'sia@sia.ir',
            'password' => bcrypt('sia'),
            'rule' => 'user',
            'status' => 'suspended',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

         // User: Amireza Bazargani
         DB::table('users')->insert([
            'name' => 'امیرضا بازرگانی',
            'email' => 'amir@amir.ir',
            'password' => bcrypt('amir'),
            'rule' => 'user',
            'status' => 'suspended',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
