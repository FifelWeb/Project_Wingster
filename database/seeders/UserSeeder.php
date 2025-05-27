<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //verify password
        DB::table('users')->insert([
            [
                'name'=>'wingster',
                'email'=>'wingster@gmail.com',
                'password'=>bcrypt('wingster'),
                'role'=>'admin',
                'is_active'=>true
            ],

            //User
            [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'customer', // ✅
                'is_active' => 1
            ]
            ]);
    }
}
