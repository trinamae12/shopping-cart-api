<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin'),
            'role_id' => 1,
        ]);

        DB::table('users')->insert([
            'name' => 'seller',
            'email' => 'seller@email.com',
            'password' => Hash::make('seller'),
            'role_id' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'customer',
            'email' => 'customer@email.com',
            'password' => Hash::make('customer'),
            'role_id' => 3,
        ]);
    }
}
