<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tables')->insert([
            ['nomor_meja' => 'Meja 1', 'kapasitas' => 2, 'tersedia' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nomor_meja' => 'Meja 2', 'kapasitas' => 4, 'tersedia' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nomor_meja' => 'Meja VIP', 'kapasitas' => 6, 'tersedia' => true, 'created_at' => now(), 'updated_at' => now()],
            ['nomor_meja' => 'Meja Bar', 'kapasitas' => 2, 'tersedia' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
