<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name'=>'user',
                'email'=>'user@gmail.com',
                'password'=>bcrypt('user'),
                'role'=>'user',
                'is_active'=>true
            ]
        ]);
    }
}
